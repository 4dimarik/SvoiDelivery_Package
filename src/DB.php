<?php


namespace wooShopTBot;


use stdClass as stdClassAlias;

class DB extends SafeMySQL
{
    const INSERT = 'INSERT INTO ?n SET ?u';

    protected $query;

    protected function reset(): void
    {
        $this->query = new stdClassAlias;
    }

    /**
     * Построение базового запроса SELECT.
     * @param string $table
     * @param array $fields
     * @return DB
     */
    public function select(string $table, array $fields): DB
    {
        $this->reset();
        $this->query->base = "SELECT " . ($fields!==[])?implode(", ", $fields):'*' . " FROM " . $table;
        $this->query->type = 'select';

        return $this;
    }

    /**
     * Добавление условия WHERE.
     * @param string $field
     * @param string $value
     * @param string $operator
     * @return DB
     */
    public function where(string $field, string $value, string $operator = '='): DB
    {
        if (in_array($this->query->type, ['select', 'update', 'delete'])) {
            $this->query->where[] = "$field $operator '$value'";
        }

        return $this;
    }
    /**
     * Получение окончательной строки запроса.
     */
    public function getSafeMySQL(): string
    {
        $query = $this->query;
        $sql = $query->base;
        if (!empty($query->where)) {
            $sql .= " WHERE " . implode(' AND ', $query->where);
        }
        return $sql;
    }


}