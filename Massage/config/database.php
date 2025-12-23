<?php
/**
 * ไฟล์สำหรับจัดการการเชื่อมต่อฐานข้อมูล MySQL
 * ใช้ mysqli extension (ไม่ใช้ PDO ตามความต้องการ)
 * 
 * @author Software Engineer Team
 * @version 1.0
 * @since 2025-12-23
 */

// โหลด configuration
require_once dirname(__FILE__) . '/config.php';

/**
 * Class Database
 * จัดการการเชื่อมต่อและ query ฐานข้อมูล
 */
class Database
{
    private $connection;
    private $last_error;
    
    /**
     * Constructor - สร้างการเชื่อมต่อฐานข้อมูล
     */
    public function __construct()
    {
        $this->connect();
    }
    
    /**
     * สร้างการเชื่อมต่อกับ MySQL database
     * 
     * @return void
     */
    private function connect()
    {
        // สร้างการเชื่อมต่อ
        $this->connection = mysqli_connect(
            DB_HOST, 
            DB_USER, 
            DB_PASS, 
            DB_NAME
        );
        
        // ตรวจสอบการเชื่อมต่อ
        if (!$this->connection) {
            $this->last_error = 'Database connection failed: ' . mysqli_connect_error();
            die('ไม่สามารถเชื่อมต่อฐานข้อมูลได้: ' . mysqli_connect_error());
        }
        
        // ตั้งค่า charset เป็น UTF-8
        mysqli_set_charset($this->connection, 'utf8');
    }
    
    /**
     * ปิดการเชื่อมต่อฐานข้อมูล
     * 
     * @return void
     */
    public function close()
    {
        if ($this->connection) {
            mysqli_close($this->connection);
        }
    }
    
    /**
     * ดึงข้อมูล connection object
     * 
     * @return mysqli|false
     */
    public function getConnection()
    {
        return $this->connection;
    }
    
    /**
     * Escape string เพื่อป้องกัน SQL injection
     * 
     * @param string $value ค่าที่ต้องการ escape
     * @return string ค่าที่ escape แล้ว
     */
    public function escape($value)
    {
        return mysqli_real_escape_string($this->connection, $value);
    }
    
    /**
     * Execute query และคืนค่า result
     * 
     * @param string $sql คำสั่ง SQL
     * @return mysqli_result|bool
     */
    public function query($sql)
    {
        $result = mysqli_query($this->connection, $sql);
        
        if (!$result) {
            $this->last_error = mysqli_error($this->connection);
            error_log("Database query error: " . $this->last_error . " | SQL: " . $sql);
        }
        
        return $result;
    }
    
    /**
     * Execute SELECT query และคืนค่าเป็น array
     * 
     * @param string $sql คำสั่ง SQL SELECT
     * @return array|false ผลลัพธ์เป็น array หรือ false ถ้าผิดพลาด
     */
    public function select($sql)
    {
        $result = $this->query($sql);
        
        if (!$result) {
            return false;
        }
        
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        
        mysqli_free_result($result);
        return $data;
    }
    
    /**
     * Execute SELECT query และคืนค่าแถวเดียว
     * 
     * @param string $sql คำสั่ง SQL SELECT
     * @return array|null ผลลัพธ์เป็น array หรือ null ถ้าไม่พบข้อมูล
     */
    public function selectOne($sql)
    {
        $result = $this->query($sql);
        
        if (!$result) {
            return null;
        }
        
        $row = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        
        return $row;
    }
    
    /**
     * Execute INSERT query และคืนค่า last insert ID
     * 
     * @param string $sql คำสั่ง SQL INSERT
     * @return int|false last insert ID หรือ false ถ้าผิดพลาด
     */
    public function insert($sql)
    {
        $result = $this->query($sql);
        
        if ($result) {
            return mysqli_insert_id($this->connection);
        }
        
        return false;
    }
    
    /**
     * Execute UPDATE query และคืนค่าจำนวนแถวที่ถูก update
     * 
     * @param string $sql คำสั่ง SQL UPDATE
     * @return int|false จำนวนแถวที่ถูก update หรือ false ถ้าผิดพลาด
     */
    public function update($sql)
    {
        $result = $this->query($sql);
        
        if ($result) {
            return mysqli_affected_rows($this->connection);
        }
        
        return false;
    }
    
    /**
     * Execute DELETE query และคืนค่าจำนวนแถวที่ถูกลบ
     * 
     * @param string $sql คำสั่ง SQL DELETE
     * @return int|false จำนวนแถวที่ถูกลบ หรือ false ถ้าผิดพลาด
     */
    public function delete($sql)
    {
        $result = $this->query($sql);
        
        if ($result) {
            return mysqli_affected_rows($this->connection);
        }
        
        return false;
    }
    
    /**
     * นับจำนวนแถวในตาราง
     * 
     * @param string $table ชื่อตาราง
     * @param string $where เงื่อนไข WHERE (optional)
     * @return int จำนวนแถว
     */
    public function count($table, $where = '')
    {
        $sql = "SELECT COUNT(*) as total FROM $table";
        
        if (!empty($where)) {
            $sql .= " WHERE $where";
        }
        
        $result = $this->selectOne($sql);
        
        return $result ? (int)$result['total'] : 0;
    }
    
    /**
     * ตรวจสอบว่ามีข้อมูลอยู่ในตารางหรือไม่
     * 
     * @param string $table ชื่อตาราง
     * @param string $where เงื่อนไข WHERE
     * @return bool true ถ้ามีข้อมูล, false ถ้าไม่มี
     */
    public function exists($table, $where)
    {
        return $this->count($table, $where) > 0;
    }
    
    /**
     * ดึงข้อมูล error ล่าสุด
     * 
     * @return string error message
     */
    public function getError()
    {
        return $this->last_error;
    }
    
    /**
     * เริ่มต้น transaction
     * 
     * @return bool
     */
    public function beginTransaction()
    {
        return mysqli_begin_transaction($this->connection);
    }
    
    /**
     * Commit transaction
     * 
     * @return bool
     */
    public function commit()
    {
        return mysqli_commit($this->connection);
    }
    
    /**
     * Rollback transaction
     * 
     * @return bool
     */
    public function rollback()
    {
        return mysqli_rollback($this->connection);
    }
    
    /**
     * Destructor - ปิดการเชื่อมต่อเมื่อ object ถูกทำลาย
     */
    public function __destruct()
    {
        $this->close();
    }
}

/**
 * สร้าง global instance ของ Database class
 * 
 * @return Database
 */
function getDatabase()
{
    static $db = null;
    
    if ($db === null) {
        $db = new Database();
    }
    
    return $db;
}

?>
