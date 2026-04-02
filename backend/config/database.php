<?php
// Database configuration file
// Uses PDO for better MySQL 8.0 compatibility

define('DB_HOST', 'localhost');
define('DB_NAME', 'myself_info');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_CHARSET', 'utf8mb4');

// Create database connection with MySQL 8.0 support
function getDBConnection() {
    $errorMessages = [];
    
    // Try PDO first with MySQL 8.0 compatibility options
    try {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . DB_CHARSET . " COLLATE utf8mb4_unicode_ci",
            // Disable SSL verification for local development
            PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
            PDO::MYSQL_ATTR_SSL_CA => false,
        ];
        
        // Try connecting with PDO
        $pdo = @new PDO($dsn, DB_USER, DB_PASS, $options);
        return $pdo;
    } catch (PDOException $e) {
        $errorMessages[] = "PDO Error: " . $e->getMessage();
    }
    
    // Try mysqli with flags for MySQL 8.0 compatibility
    try {
        $conn = @new mysqli();
        $conn->options(MYSQLI_OPT_CONNECT_TIMEOUT, 10);
        $conn->options(MYSQLI_OPT_LOCAL_INFILE, true);
        
        // Try connecting
        @$conn->real_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
        if (!$conn->connect_error) {
            $conn->set_charset(DB_CHARSET);
            return $conn;
        } else {
            $errorMessages[] = "MySQLi Error: " . $conn->connect_error;
        }
    } catch (Exception $e) {
        $errorMessages[] = "MySQLi Exception: " . $e->getMessage();
    }
    
    // If all connections fail, show detailed error with solution
    $errorHtml = "<h2>Database Connection Error</h2>";
    $errorHtml .= "<p><strong>Error:</strong> The server requested authentication method unknown to the client</p>";
    $errorHtml .= "<p>This is a MySQL 8.0 compatibility issue with PHP.</p>";
    $errorHtml .= "<h3>Solutions:</h3>";
    $errorHtml .= "<ol>";
    $errorHtml .= "<li><strong>Option 1 (Recommended):</strong> Change MySQL user authentication method to mysql_native_password<br>";
    $errorHtml .= "Run this SQL command in MySQL:<br>";
    $errorHtml .= "<code>ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'root';</code><br>";
    $errorHtml .= "<code>FLUSH PRIVILEGES;</code></li><br><br>";
    $errorHtml .= "<li><strong>Option 2:</strong> Update PHP to version 7.4+ with mysqlnd extension that supports caching_sha2_password</li><br>";
    $errorHtml .= "<li><strong>Option 3:</strong> Check if MySQL service is running on port 3306</li>";
    $errorHtml .= "</ol>";
    $errorHtml .= "<h3>Debug Information:</h3>";
    $errorHtml .= "<pre>" . implode("\n", $errorMessages) . "</pre>";
    
    die($errorHtml);
}

// Helper function to check if using PDO
function isPDO($conn) {
    return $conn instanceof PDO;
}

// Helper function to execute query
function executeQuery($conn, $sql, $params = []) {
    if (isPDO($conn)) {
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    } else {
        // For mysqli, we need to handle params manually for simple queries
        if (empty($params)) {
            return $conn->query($sql);
        } else {
            // Simple parameter replacement for mysqli (not as secure as PDO)
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                // Build type string
                $types = '';
                foreach ($params as $param) {
                    if (is_int($param)) {
                        $types .= 'i';
                    } elseif (is_double($param)) {
                        $types .= 'd';
                    } else {
                        $types .= 's';
                    }
                }
                $stmt->bind_param($types, ...$params);
                $stmt->execute();
                return $stmt->get_result();
            }
            return false;
        }
    }
}
?>