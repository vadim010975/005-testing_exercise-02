<?php
declare(strict_types=1);

namespace App;
require_once 'UserTableWrapper.php';

use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

class UserTableWrapperTest extends TestCase
{
    #[TestWith([['id' => 1, 'name' => 'Алексей', 'phone' => '+79031234567']])]
    #[TestWith([['id' => 2, 'name' => 'Виктор', 'phone' => '+79041234567']])]
    public function testInsert($row): void
    {
        $userTableWrapper = new UserTableWrapper();
        $userTableWrapper->insert($row);
        $result = $userTableWrapper->get();
        $this->assertContains($row, $result);

        $id_count = count(array_filter($result, fn($el) => $el['id'] === $row['id']));
        $this->assertEquals(1, $id_count);
    }

    #[TestWith([1, ['name' => 'Алексей', 'phone' => '+79031234567']])]
    #[TestWith([2, ['name' => 'Виктор', 'phone' => '+79041234567']])]
    public function testUpdate($id, $values): void
    {
        $userTableWrapper = new UserTableWrapper();
        $userTableWrapper->insert(['id' => 1, 'name' => 'Ольга', 'phone' => '+79278888888']);
        $userTableWrapper->insert(['id' => 2, 'name' => 'Оксана', 'phone' => '+79279999999']);
        $result1 = $userTableWrapper->update($id, $values);
        $this->assertEquals($result1, ['id' => $id, ...$values]);

        $result2 = $userTableWrapper->get();
        $this->assertContains($result1, $result2);

        $id_count = count(array_filter($result2, fn($el) => $el['id'] === $id));
        $this->assertEquals(1, $id_count);
    }

    #[TestWith([2, ['id' => 1, 'name' => 'Алексей', 'phone' => '+79031234567']])]
    #[TestWith([1, ['id' => 2, 'name' => 'Виктор', 'phone' => '+79041234567']])]
    public function testDelete($id, $values): void
    {
        $userTableWrapper = new UserTableWrapper();
        $userTableWrapper->insert(['id' => 1, 'name' => 'Алексей', 'phone' => '+79031234567']);
        $userTableWrapper->insert(['id' => 2, 'name' => 'Виктор', 'phone' => '+79041234567']);
        $userTableWrapper->delete($id);
        $result = $userTableWrapper->get();
        $this->assertEquals([$values], $result);
    }

    public function testGet()
    {
        $data = [
            ['id' => 1, 'name' => 'Ольга', 'phone' => '+79278888888'],
            ['id' => 2, 'name' => 'Оксана', 'phone' => '+79279999999'],
            ['id' => 3, 'name' => 'Ксения', 'phone' => '+79270000000']
        ];
        $userTableWrapper = new UserTableWrapper();
        $userTableWrapper->insert($data[0]);
        $userTableWrapper->insert($data[1]);
        $userTableWrapper->insert($data[2]);
        $userTableWrapper->delete(2);
        $result = $userTableWrapper->get();
        $this->assertEquals([$data[0], $data[2]], $result);
    }
}
