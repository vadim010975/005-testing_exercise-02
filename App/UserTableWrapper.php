<?php
declare(strict_types=1);

namespace App;

class UserTableWrapper
{
    private array $rows;

    /**
     * @param array|$values [column => row_value] $values
     */
    public function insert(array $values): void
    {
        $this->rows[] = $values;
    }
    public function update(int $id, array $values): array
    {
        foreach ($this->rows as &$row) {
            if ($row['id'] === $id) {
                $row = ['id' => $id];
                foreach($values as $key => $value) {
                    $row[$key] = $value;
                }
                return $row;
            }
        }
        return [];
    }

    public function delete(int $id): void
    {
        for ($i = 0; $i < count($this->rows); $i++) {
            if ($this->rows[$i]['id'] === $id) {
                array_splice($this->rows, $i, 1);
//                unset($this->rows[$i]);
                return;
            }
        }
    }

    public function get(): array
    {
        return $this->rows;
    }
}