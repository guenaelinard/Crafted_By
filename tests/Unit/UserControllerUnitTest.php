<?php

namespace Tests\Unit;

use Illuminate\Support\Carbon;
use Tests\TestCase;
use App\Http\Controllers\UserController;
use App\Models\User;

class UserControllerUnitTest extends TestCase
{
    public function testShowMethodShouldReturnAssertOk()
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        // Use the actingAs method to authenticate the user
        $response = $this->actingAs($user)->getJson('/api/users/' . $user->id);

        $responseData = $response->json();
        $responseData['email_verified_at'] = Carbon::parse($responseData['email_verified_at']);
        $responseData['created_at'] = Carbon::parse($responseData['created_at']);
        $responseData['updated_at'] = Carbon::parse($responseData['updated_at']);

        // Assert
        $response->assertStatus(200);
        $this->assertEquals([
            'id' => $user->id,
            'username' => $user->username,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'email_verified_at' => $user->email_verified_at,
            'address' => $user->address,
            'city' => $user->city,
            'zipcode' => $user->zipcode,
            'phone_number' => $user->phone_number,
            'image' => $user->image,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at
        ], $responseData);
    }

public function testStoreMethodShouldAssertOkay()
{
    // Arrange
    $user = User::factory()->create();
    $newUserData = [
        'username' => 'newuser',
        'first_name' => 'New',
        'last_name' => 'User',
        'email' => 'newuser@example.com',
        'password' => bcrypt('password'),
        'email_verified_at' => now()->toDateTimeString(),
        'address' => '123 New User St',
        'city' => 'New User City',
        'zipcode' => '12345',
        'phone_number' => '123-456-7890',
        'image' => 'https://via.placeholder.com/640x480.png/009977?text=newuser',
    ];

    // Act
    $response = $this->actingAs($user)->postJson('/api/users', $newUserData);

    // Assert
    $response->assertStatus(201);
    $this->assertDatabaseHas('users', ['username' => 'newuser']);
    }

    public function testUpdateMethodShouldAssertOkay()
    {
        // Arrange
        $user = User::factory()->create();
        $updatedUserData = [
            'username' => 'updateduser',
            'first_name' => 'Updated',
            'last_name' => 'User',
            'email' => 'updateduser@example.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now()->toDateTimeString(),
            'address' => '123 Updated User St',
            'city' => 'Updated User City',
            'zipcode' => '12345',
            'phone_number' => '123-456-7890',
            'image' => 'https://via.placeholder.com/640x480.png/009977?text=updateduser',
        ];

        // Act
        $response = $this->actingAs($user)->putJson('/api/users/' . $user->id, $updatedUserData);

        // Assert
        $response->assertStatus(200);
        $this->assertDatabaseHas('users', ['username' => 'updateduser']);
    }

    public function testDestroyMethodShouldAssertOkay()
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $response = $this->actingAs($user)->deleteJson('/api/users/' . $user->id);

        // Assert
        $response->assertStatus(204);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function testSearchByUsernameMethodShouldAssertOkay()
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $response = $this->actingAs($user)->getJson('/api/users/search/' . $user->username);

        // Assert
        $response->assertStatus(200);
        $this->assertNotEmpty($response->json());
    }
}
