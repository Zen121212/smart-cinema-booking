<?php 

abstract class Model{
    protected static string $table;
    protected static string $primary_key = "id";
    protected static ?mysqli $mysqli = null;

    public static function setConnection(mysqli $mysqli) {
        static::$mysqli = $mysqli;
    }
    private static function detectTypes($values) {
        if (!is_array($values)) {
            $values = [$values];
        }
        $types = '';
        foreach ($values as $value) {
            if (is_null($value)) {
                $types .= 's';
            } elseif (is_int($value)) {
                $types .= 'i';
            } elseif (is_float($value) || is_double($value)) {
                $types .= 'd';
            } elseif (is_bool($value)) {
                $types .= 'i';
            } else {
                $types .= 's';
            }
        }
        
        return $types;
    }
    public static function all(){
        $sql = sprintf("Select * from %s", static::$table);
        $query = static::$mysqli->prepare($sql);
        $query->execute();
        
        $data = $query->get_result();
        
        $objects = [];
        while($row = $data->fetch_assoc()){
             $count++;
            $objects[] = new static($row); //creating an object of type "static" / "parent" and adding the object to the array
        }
        return $objects; //we are returning an array of objects!!!!!!!!c
    }
    public static function find($value, $key = null) {
        $key = $key ?? static::$primary_key;
        
        $sql = sprintf("SELECT * FROM %s WHERE %s = ? LIMIT 1", static::$table, $key);
        $query = static::$mysqli->prepare($sql);

        $type = self::detectTypes([$value]);
        
        $query->bind_param($type, $value);
        $query->execute();
        
        $data = $query->get_result()->fetch_assoc();

        return $data ? new static($data) : null;
    }
    public static function findAll($value, $key = null) {
        $key = $key ?? static::$primary_key;

        $sql = sprintf(
            "SELECT * FROM %s WHERE %s = ?",
            static::$table,
            $key
        );
        $query = static::$mysqli->prepare($sql);

        $type = self::detectTypes([$value]);
        $query->bind_param($type, $value);
        
        $query->execute();

        $result = $query->get_result();

        $objects = [];

        while ($row = $result->fetch_assoc()) {
            $objects[] = new static($row);
        }
        return $objects;
    }

    public static function update( $id, array $data) {

        $columns = array_keys($data);
        $assignmentsArray = [];
        foreach ($columns as $col) {
            $assignmentsArray[] = "$col = ?";
        }
        $assignments = implode(', ', $assignmentsArray);

        $values = array_values($data);

        $types = self::detectTypes($values);

        $sql = sprintf(
            "UPDATE %s SET %s WHERE %s = ?",
            static::$table,
            $assignments,
            static::$primary_key
        );

        $query = static::$mysqli->prepare($sql);
        $values[] = $id;

        $types .= "i";

        $query->bind_param($types, ...$values);
        $query->execute();

        $updatedRow = static::find($id, static::$primary_key);
        return $updatedRow;
    }

    public static function create(array $data) {
        $columns = array_keys($data);
        $placeholders = implode(', ', array_fill(0, count($columns), '?'));
        $columnList = implode(', ', $columns);
        $values = array_values($data);

        $types = self::detectTypes($values);

        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            static::$table,
            $columnList,
            $placeholders
        );
        $query = static::$mysqli->prepare($sql);

        $query->bind_param($types, ...$values);
        $query->execute();
        $data['id'] = static::$mysqli->insert_id;
        return new static($data);
    }
    public static function delete( int $id){
        $sql = sprintf("Delete from %s WHERE %s = ?", 
                        static::$table, 
                        static::$primary_key);
        $query = static::$mysqli->prepare($sql);

        $query->bind_param("i", $id);
        $query->execute();

        return $query->affected_rows;
    }

}



