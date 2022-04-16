<?php


namespace Tests\Feature\Posts;


use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class PostManagementTest extends TestCase
{
    use RefreshDatabase;

    const ADMIN_EMAIL = 'admin@company';
    const USER_EMAIL = 'user@company';

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed([
            'RolesTableSeeder',
            'UsersTableSeeder',
        ]);
    }

    /**
     * @test
     * @group posts
     */
    public function api_is_accessible()
    {
        $this->json('get', 'api/posts')
            ->assertStatus(200);
    }

    /**
     * @test
     * @group posts
     */
    public function admin_can_create_post()
    {
        Passport::actingAs(User::where('email', self::ADMIN_EMAIL)->first());

        $data = [
            'title'   => 'Post title',
            'content' => 'The quick brown fox jumps over the lazy dog',
        ];

        $this->json('post', 'api/posts', $data)
            ->assertStatus(201)
            ->getContent();

        $this->assertDatabaseHas('posts', $data);
    }

    /**
     * @test
     * @group posts
     */
    public function admin_can_update_a_post()
    {
        Passport::actingAs(User::where('email', self::ADMIN_EMAIL)->first());

        $data = [
            'title' => 'Updated post title',
        ];

        $post = factory(Post::class)->create();

        $this->json('put', 'api/posts/' . $post->id, $data)
            ->assertStatus(200);

        $this->assertDatabaseHas('posts', $data);
    }

    /**
     * @test
     * @group posts
     */
    public function admin_can_delete_a_post()
    {
        Passport::actingAs(User::where('email', self::ADMIN_EMAIL)->first());

        $post = factory(Post::class)->create();

        $this->json('delete', 'api/posts/' . $post->id)
            ->assertStatus(204);

        $this->assertDatabaseMissing('posts', $post->toArray());
    }

    /**
     * @test
     * @group posts
     */
    public function invalid_input_is_not_acceptable()
    {
        Passport::actingAs(User::where('email', self::ADMIN_EMAIL)->first());

        $data = [
            'title' => 78363,
        ];

        $this->json('post', 'api/posts/', $data)->assertStatus(422);

        $this->assertDatabaseMissing('posts', $data);
    }

    /**
     * @test
     * @group posts
     */
    public function user_not_allowed_to_create_post()
    {
        Passport::actingAs(User::where('email', self::USER_EMAIL)->first());

        $data = [
            'title'   => 'Post title',
            'content' => 'The quick brown fox jumps over the lazy dog',
        ];

        $this->json('post', 'api/posts', $data)
            ->assertStatus(403);

        $this->assertDatabaseMissing('posts', $data);
    }

    /**
     * @test
     * @group posts
     */
    public function user_not_allowed_to_update_posts()
    {
        Passport::actingAs(User::where('email', self::USER_EMAIL)->first());

        $data = [
            'title' => 'Updated post title',
        ];

        $post = factory(Post::class)->create();

        $this->json('put', 'api/posts/' . $post->id, $data)
            ->assertStatus(403);

        $this->assertDatabaseMissing('posts', $data);
    }

    /**
     * @test
     * @group posts
     */
    public function user_not_allowed_to_delete_a_post()
    {
        Passport::actingAs(User::where('email', self::USER_EMAIL)->first());

        $post = factory(Post::class)->create();

        $this->json('delete', 'api/posts/' . $post->id)
            ->assertStatus(403);

        $this->assertDatabaseHas('posts', $post->toArray());
    }
}