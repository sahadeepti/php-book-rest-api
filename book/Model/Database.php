<?php
    class Database
    {
        protected $connection = null;
        public function __construct()
        {
            try {
                $this->connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME);
                if(mysqli_connect_error())
                {
                    throw new Exception("Could not connect to database.");
                } 
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
        }

        public function select($query="", $params = [])
        {
            try{
                $stmt = $this->executeStatement($query, $params);
                $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                $stmt->close();
                return $result;
            } catch(Exception $e) {
                throw new Exception($e->getMessage());
            }
        }

        public function insert($query="", $params = [])
        {
            try{
                $stmt = $this->executeStatement($query, $params);
                $result = $stmt->insert_id;
                $stmt->close();
                return $result;
            } catch(Exception $e) {
                throw new Exception($e->getMessage());
            }
        }

        public function updateDelete($query="", $params = [])
        {
            try{
                $stmt = $this->executeStatement($query,$params);
                $stmt->close();
            } catch (Exception $e)
            {
                throw new Exception($e->getMessage());
            }
        }

        private function executeStatement($query, $params = [])
        {
            try{
                $cp = count($params);
                $stmt = $this->connection->prepare($query);
                switch($cp) {
                    case 3:
                        $stmt->bind_param($params[0], $params[1], $params[2]);
                        break;
                    case 4:
                        $stmt->bind_param($params[0], $params[1], $params[2], $params[3]);
                        break;
                    case 5:
                        $stmt->bind_param($params[0], $params[1], $params[2], $params[3], $params[4]);
                        break;
                     case 6:
                        $stmt->bind_param($params[0], $params[1], $params[2], $params[3], $params[4], $params[5]);
                        break;
                    default:
                        $stmt->bind_param($params[0], $params[1]);
                }
                $stmt->execute();
                return $stmt;
            } catch(Exception $e){
                throw new Exception($e->getMessage());
            }
        }
    }
?>