<?php

use App\Models\City;
use Faker\Extension\GeneratorAwareExtensionTrait;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CityResourceTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @var Faker
     */
    private $faker;

    /**
     * If needed
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->faker = Faker\Factory::create();
    }

    /**
     *
     */
    public function testUserCanGetResourceListing()
    {
        City::factory()->count(3)->create();

        $this->get(route('city.index'));
        $this->assertResponseStatus(Response::HTTP_OK);
        $this->response->assertJsonCount(3);
    }

    /**
     *
     */
    public function testUserCanCreateResource()
    {
        $input = [
            'name' => $this->faker->city()
        ];

        $this->post('/cities', $input);
        $this->assertResponseStatus(Response::HTTP_CREATED);
        $this->response->assertJsonFragment($input);
    }

    /**
     *
     */
    public function testUserCanShowResourceListing()
    {
        $city = City::factory()->create();

        $this->get(route('city.show'));
        $this->assertResponseStatus(Response::HTTP_OK);

    }

    /**
     *
     */
    public function testUserCanUpdateResource()
    {
        $city = City::factory()->create();
        $newName =  $this->faker->city();

        $this->assertNotEquals($city->name, $newName);

        $input = [
            'name' => $newName
        ];

        $this->put(route('city.update', ['city' => $city->id]), $input);
        $this->assertResponseStatus(Response::HTTP_OK);
        $this->response->assertJsonFragment($input);
    }

    public function testUserCanDeleteResource()
    {
        $city = City::factory()->create();
        $this->delete(route('city.delete', ['city' => $city->id]));
        $this->assertResponseStatus(Response::HTTP_OK);

        // Is it deleted?
        $deleted = City::find($city->id);
        $this->assertNull($deleted);

        // restore
        $this->patch(route('city.restore', ['id' => $city->id]));
        $this->assertResponseStatus(Response::HTTP_OK);

        $this->response->assertJsonFragment([
            'id' => $city->id,
            'name' => $city->name,
        ]);
    }
}
