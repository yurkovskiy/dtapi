<?php defined('SYSPATH') or die('No direct script access.');

class Database_PDO_MySQL extends Database_PDO {
    public function list_columns($table, $like = NULL, $add_prefix = TRUE)
    {
            // Quote the table name
            $table = ($add_prefix === TRUE) ? $this->quote_table($table) : $table;

            if (is_string($like))
            {
                    // Search for column names
                    $result = $this->query(Database::SELECT, 'SHOW FULL COLUMNS FROM '.$table.' LIKE '.$this->quote($like), FALSE);
            }
            else
            {
                    // Find all column names
                    $result = $this->query(Database::SELECT, 'SHOW FULL COLUMNS FROM '.$table, FALSE);
            }

            $count = 0;
            $columns = array();
            foreach ($result as $row)
            {
                    list($type, $length) = $this->_parse_type($row['Type']);

                    $column = $this->datatype($type);

                    $column['column_name']      = $row['Field'];
                    $column['column_default']   = $row['Default'];
                    $column['data_type']        = $type;
                    $column['is_nullable']      = ($row['Null'] == 'YES');
                    $column['ordinal_position'] = ++$count;

                    switch ($type) //was $column['type']
                    {
                            case 'float':
                                    if (isset($length))
                                    {
                                            list($column['numeric_precision'], $column['numeric_scale']) = explode(',', $length);
                                    }
                            break;
                            case 'int':
                                    if (isset($length))
                                    {
                                            // MySQL attribute
                                            $column['display'] = $length;
                                    }
                            break;
                           case 'string':
                                    switch ($column['data_type'])
                                    {
                                            case 'binary':
                                            case 'varbinary':
                                                    $column['character_maximum_length'] = $length;
                                            break;
                                            case 'char':
                                            case 'varchar':
                                                    $column['character_maximum_length'] = $length;
                                            case 'text':
                                            case 'tinytext':
                                            case 'mediumtext':
                                            case 'longtext':
                                                    $column['collation_name'] = $row['Collation'];
                                            break;
                                            case 'enum':
                                            case 'set':
                                                    $column['collation_name'] = $row['Collation'];
                                                    $column['options'] = explode('\',\'', substr($length, 1, -1));
                                            break;
                                    }
                            break;
                    }

                    // MySQL attributes
                    $column['comment']      = $row['Comment'];
                    $column['extra']        = $row['Extra'];
                    $column['key']          = $row['Key'];
                    $column['privileges']   = $row['Privileges'];

                    $columns[$row['Field']] = $column;
            }

            return $columns;
    }
}

?>