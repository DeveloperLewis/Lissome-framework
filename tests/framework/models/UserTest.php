<?php

namespace framework\models;

use classes\server\Database;
use models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        $this->user = new User();
    }

    public function testCreate(): void
    {
        $this->user->create("myUsername", "email@email.com", "password", "10/04/1789");
        $username = $this->user->username;
        $email = $this->user->email;
        $passwordBool = password_verify("password", $this->user->password);
        $date = $this->user->account_creation_date;

        $this->assertSame("myUsername", $username);
        $this->assertSame("email@email.com", $email);
        $this->assertTrue($passwordBool);
        $this->assertSame("10/04/1789", $date);
    }

    public function testStore(): void
    {
        $this->user->create("testingUsername..500", "notrealema,il@email.com", "password", "09/03/1987");
        $this->user->store();

        $database = new Database();
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $database->getPdo()->prepare($sql);

        $stmt->execute(["testingUsername..500"]);
        $user = $stmt->fetch();

        $this->assertNotEmpty($user);
    }

    public function testAuthenticate(): void
    {
        $userId = $this->user->authenticate("notrealema,il@email.com", "password");
        $this->assertNotEmpty($userId);
        $this->assertIsInt($userId);
    }

    public function testGet(): void
    {
        $userId = $this->user->authenticate("notrealema,il@email.com", "password");
        $this->user->get($userId);

        $this->assertEquals("testingUsername..500", $this->user->username);
        $this->assertEquals("notrealema,il@email.com", $this->user->email);
    }

    public function testDelete(): void
    {
        $userId = $this->user->authenticate("notrealema,il@email.com", "password");
        $this->user->delete($userId);

        $database = new Database();
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $database->getPdo()->prepare($sql);

        $stmt->execute(["testingUsername..500"]);
        $isEmpty = false;

        if (!$user = $stmt->fetch())
        {
            $isEmpty = true;
        }

        $this->assertTrue($isEmpty);
    }

}