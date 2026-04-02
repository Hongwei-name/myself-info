<?php
// API interface file
// Set response headers
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Include database configuration
require_once 'config/database.php';

// Get request path
$path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
$method = $_SERVER['REQUEST_METHOD'];

// Route handling
switch($path) {
    case '/api/personal':
        if ($method == 'GET') {
            getPersonalInfo();
        } elseif ($method == 'POST') {
            updatePersonalInfo();
        }
        break;
    case '/api/skills':
        if ($method == 'GET') {
            getSkills();
        } elseif ($method == 'POST') {
            addSkill();
        }
        break;
    case '/api/skills/':
    case '/api/skills':
        if (preg_match('/\/api\/skills\/(\d+)/', $path, $matches)) {
            $id = $matches[1];
            if ($method == 'PUT') {
                updateSkill($id);
            } elseif ($method == 'DELETE') {
                deleteSkill($id);
            }
        }
        break;
    case '/api/experiences':
        if ($method == 'GET') {
            getExperiences();
        } elseif ($method == 'POST') {
            addExperience();
        }
        break;
    case '/api/experiences/':
    case '/api/experiences':
        if (preg_match('/\/api\/experiences\/(\d+)/', $path, $matches)) {
            $id = $matches[1];
            if ($method == 'PUT') {
                updateExperience($id);
            } elseif ($method == 'DELETE') {
                deleteExperience($id);
            }
        }
        break;
    case '/api/projects':
        if ($method == 'GET') {
            getProjects();
        } elseif ($method == 'POST') {
            addProject();
        }
        break;
    case '/api/projects/':
    case '/api/projects':
        if (preg_match('/\/api\/projects\/(\d+)/', $path, $matches)) {
            $id = $matches[1];
            if ($method == 'PUT') {
                updateProject($id);
            } elseif ($method == 'DELETE') {
                deleteProject($id);
            }
        }
        break;
    case '/api/contact':
        if ($method == 'GET') {
            getContactInfo();
        } elseif ($method == 'POST') {
            addContactInfo();
        }
        break;
    case '/api/contact/':
    case '/api/contact':
        if (preg_match('/\/api\/contact\/(\d+)/', $path, $matches)) {
            $id = $matches[1];
            if ($method == 'PUT') {
                updateContactInfo($id);
            } elseif ($method == 'DELETE') {
                deleteContactInfo($id);
            }
        }
        break;
    case '/api/education':
        if ($method == 'GET') {
            getEducation();
        } elseif ($method == 'POST') {
            addEducation();
        }
        break;
    case '/api/education/':
    case '/api/education':
        if (preg_match('/\/api\/education\/(\d+)/', $path, $matches)) {
            $id = $matches[1];
            if ($method == 'PUT') {
                updateEducation($id);
            } elseif ($method == 'DELETE') {
                deleteEducation($id);
            }
        }
        break;
    case '/api/stats':
        if ($method == 'GET') {
            getStats();
        }
        break;
    default:
        http_response_code(404);
        echo json_encode(["error" => "Interface does not exist"]);
        break;
}

// Get personal info
function getPersonalInfo() {
    $conn = getDBConnection();
    try {
        if (isPDO($conn)) {
            $stmt = $conn->query("SELECT * FROM personal_info WHERE id=1");
            $personal_info = $stmt->fetch();
        } else {
            $result = $conn->query("SELECT * FROM personal_info WHERE id=1");
            $personal_info = $result->fetch_assoc();
        }
        echo json_encode($personal_info);
    } catch (Exception $e) {
        echo json_encode(["error" => "Failed to get personal info: " . $e->getMessage()]);
    }
    $conn = null;
}

// Update personal info
function updatePersonalInfo() {
    $conn = getDBConnection();
    $data = json_decode(file_get_contents('php://input'), true);
    
    try {
        if (isPDO($conn)) {
            $stmt = $conn->prepare("UPDATE personal_info SET name=?, title=?, slogan=?, description=?, avatar=?, phone=?, email=?, university=?, major=?, english_cert=?, web_cert=?, education_courses=? WHERE id=1");
            $stmt->execute([
                $data['name'], $data['title'], $data['slogan'], $data['description'],
                $data['avatar'], $data['phone'], $data['email'], $data['university'],
                $data['major'], $data['english_cert'], $data['web_cert'],
                $data['education_courses'] ?? ''
            ]);
        } else {
            $sql = "UPDATE personal_info SET name='{$data['name']}', title='{$data['title']}', slogan='{$data['slogan']}', description='{$data['description']}', avatar='{$data['avatar']}', phone='{$data['phone']}', email='{$data['email']}', university='{$data['university']}', major='{$data['major']}', english_cert='{$data['english_cert']}', web_cert='{$data['web_cert']}', education_courses='{$data['education_courses']}' WHERE id=1";
            $conn->query($sql);
        }
        echo json_encode(["success" => "Personal info updated successfully"]);
    } catch (Exception $e) {
        echo json_encode(["error" => "Update failed: " . $e->getMessage()]);
    }
    $conn = null;
}

// Get skills list
function getSkills() {
    $conn = getDBConnection();
    try {
        if (isPDO($conn)) {
            $stmt = $conn->query("SELECT s.*, c.name as category_name FROM skills s LEFT JOIN skill_categories c ON s.category_id = c.id ORDER BY s.id ASC");
            $skills = $stmt->fetchAll();
        } else {
            $result = $conn->query("SELECT s.*, c.name as category_name FROM skills s LEFT JOIN skill_categories c ON s.category_id = c.id ORDER BY s.id ASC");
            $skills = [];
            while ($row = $result->fetch_assoc()) {
                $skills[] = $row;
            }
        }
        echo json_encode($skills);
    } catch (Exception $e) {
        echo json_encode(["error" => "Failed to get skills: " . $e->getMessage()]);
    }
    $conn = null;
}

// Add skill
function addSkill() {
    $conn = getDBConnection();
    $data = json_decode(file_get_contents('php://input'), true);
    
    try {
        if (isPDO($conn)) {
            $stmt = $conn->prepare("INSERT INTO skills (name, level, category_id) VALUES (?, ?, ?)");
            $stmt->execute([$data['name'], $data['level'], $data['category_id']]);
        } else {
            $sql = "INSERT INTO skills (name, level, category_id) VALUES ('{$data['name']}', '{$data['level']}', '{$data['category_id']}')";
            $conn->query($sql);
        }
        echo json_encode(["success" => "Skill added successfully"]);
    } catch (Exception $e) {
        echo json_encode(["error" => "Add failed: " . $e->getMessage()]);
    }
    $conn = null;
}

// Update skill
function updateSkill($id) {
    $conn = getDBConnection();
    $data = json_decode(file_get_contents('php://input'), true);
    
    try {
        if (isPDO($conn)) {
            $stmt = $conn->prepare("UPDATE skills SET name=?, level=?, category_id=? WHERE id=?");
            $stmt->execute([$data['name'], $data['level'], $data['category_id'], $id]);
        } else {
            $sql = "UPDATE skills SET name='{$data['name']}', level='{$data['level']}', category_id='{$data['category_id']}' WHERE id=$id";
            $conn->query($sql);
        }
        echo json_encode(["success" => "Skill updated successfully"]);
    } catch (Exception $e) {
        echo json_encode(["error" => "Update failed: " . $e->getMessage()]);
    }
    $conn = null;
}

// Delete skill
function deleteSkill($id) {
    $conn = getDBConnection();
    
    try {
        if (isPDO($conn)) {
            $stmt = $conn->prepare("DELETE FROM skills WHERE id=?");
            $stmt->execute([$id]);
        } else {
            $sql = "DELETE FROM skills WHERE id=$id";
            $conn->query($sql);
        }
        echo json_encode(["success" => "Skill deleted successfully"]);
    } catch (Exception $e) {
        echo json_encode(["error" => "Delete failed: " . $e->getMessage()]);
    }
    $conn = null;
}

// Get experiences list
function getExperiences() {
    $conn = getDBConnection();
    try {
        if (isPDO($conn)) {
            $stmt = $conn->query("SELECT * FROM experiences ORDER BY id DESC");
            $experiences = $stmt->fetchAll();
        } else {
            $result = $conn->query("SELECT * FROM experiences ORDER BY id DESC");
            $experiences = [];
            while ($row = $result->fetch_assoc()) {
                $experiences[] = $row;
            }
        }
        echo json_encode($experiences);
    } catch (Exception $e) {
        echo json_encode(["error" => "Failed to get experiences: " . $e->getMessage()]);
    }
    $conn = null;
}

// Add experience
function addExperience() {
    $conn = getDBConnection();
    $data = json_decode(file_get_contents('php://input'), true);
    
    try {
        if (isPDO($conn)) {
            $stmt = $conn->prepare("INSERT INTO experiences (date, title, company, description) VALUES (?, ?, ?, ?)");
            $stmt->execute([$data['date'], $data['title'], $data['company'], $data['description']]);
        } else {
            $sql = "INSERT INTO experiences (date, title, company, description) VALUES ('{$data['date']}', '{$data['title']}', '{$data['company']}', '{$data['description']}')";
            $conn->query($sql);
        }
        echo json_encode(["success" => "Experience added successfully"]);
    } catch (Exception $e) {
        echo json_encode(["error" => "Add failed: " . $e->getMessage()]);
    }
    $conn = null;
}

// Update experience
function updateExperience($id) {
    $conn = getDBConnection();
    $data = json_decode(file_get_contents('php://input'), true);
    
    try {
        if (isPDO($conn)) {
            $stmt = $conn->prepare("UPDATE experiences SET date=?, title=?, company=?, description=? WHERE id=?");
            $stmt->execute([$data['date'], $data['title'], $data['company'], $data['description'], $id]);
        } else {
            $sql = "UPDATE experiences SET date='{$data['date']}', title='{$data['title']}', company='{$data['company']}', description='{$data['description']}' WHERE id=$id";
            $conn->query($sql);
        }
        echo json_encode(["success" => "Experience updated successfully"]);
    } catch (Exception $e) {
        echo json_encode(["error" => "Update failed: " . $e->getMessage()]);
    }
    $conn = null;
}

// Delete experience
function deleteExperience($id) {
    $conn = getDBConnection();
    
    try {
        if (isPDO($conn)) {
            $stmt = $conn->prepare("DELETE FROM experiences WHERE id=?");
            $stmt->execute([$id]);
        } else {
            $sql = "DELETE FROM experiences WHERE id=$id";
            $conn->query($sql);
        }
        echo json_encode(["success" => "Experience deleted successfully"]);
    } catch (Exception $e) {
        echo json_encode(["error" => "Delete failed: " . $e->getMessage()]);
    }
    $conn = null;
}

// Get projects list
function getProjects() {
    $conn = getDBConnection();
    try {
        if (isPDO($conn)) {
            $stmt = $conn->query("SELECT * FROM projects ORDER BY id DESC");
            $projects = $stmt->fetchAll();
        } else {
            $result = $conn->query("SELECT * FROM projects ORDER BY id DESC");
            $projects = [];
            while ($row = $result->fetch_assoc()) {
                $projects[] = $row;
            }
        }
        echo json_encode($projects);
    } catch (Exception $e) {
        echo json_encode(["error" => "Failed to get projects: " . $e->getMessage()]);
    }
    $conn = null;
}

// Add project
function addProject() {
    $conn = getDBConnection();
    $data = json_decode(file_get_contents('php://input'), true);
    
    try {
        if (isPDO($conn)) {
            $stmt = $conn->prepare("INSERT INTO projects (title, description, technologies, image) VALUES (?, ?, ?, ?)");
            $stmt->execute([$data['title'], $data['description'], $data['technologies'], $data['image']]);
        } else {
            $sql = "INSERT INTO projects (title, description, technologies, image) VALUES ('{$data['title']}', '{$data['description']}', '{$data['technologies']}', '{$data['image']}')";
            $conn->query($sql);
        }
        echo json_encode(["success" => "Project added successfully"]);
    } catch (Exception $e) {
        echo json_encode(["error" => "Add failed: " . $e->getMessage()]);
    }
    $conn = null;
}

// Update project
function updateProject($id) {
    $conn = getDBConnection();
    $data = json_decode(file_get_contents('php://input'), true);
    
    try {
        if (isPDO($conn)) {
            $stmt = $conn->prepare("UPDATE projects SET title=?, description=?, technologies=?, image=? WHERE id=?");
            $stmt->execute([$data['title'], $data['description'], $data['technologies'], $data['image'], $id]);
        } else {
            $sql = "UPDATE projects SET title='{$data['title']}', description='{$data['description']}', technologies='{$data['technologies']}', image='{$data['image']}' WHERE id=$id";
            $conn->query($sql);
        }
        echo json_encode(["success" => "Project updated successfully"]);
    } catch (Exception $e) {
        echo json_encode(["error" => "Update failed: " . $e->getMessage()]);
    }
    $conn = null;
}

// Delete project
function deleteProject($id) {
    $conn = getDBConnection();
    
    try {
        if (isPDO($conn)) {
            $stmt = $conn->prepare("DELETE FROM projects WHERE id=?");
            $stmt->execute([$id]);
        } else {
            $sql = "DELETE FROM projects WHERE id=$id";
            $conn->query($sql);
        }
        echo json_encode(["success" => "Project deleted successfully"]);
    } catch (Exception $e) {
        echo json_encode(["error" => "Delete failed: " . $e->getMessage()]);
    }
    $conn = null;
}

// Get contact info list
function getContactInfo() {
    $conn = getDBConnection();
    try {
        if (isPDO($conn)) {
            $stmt = $conn->query("SELECT * FROM contact_info ORDER BY id ASC");
            $contacts = $stmt->fetchAll();
        } else {
            $result = $conn->query("SELECT * FROM contact_info ORDER BY id ASC");
            $contacts = [];
            while ($row = $result->fetch_assoc()) {
                $contacts[] = $row;
            }
        }
        echo json_encode($contacts);
    } catch (Exception $e) {
        echo json_encode(["error" => "Failed to get contact info: " . $e->getMessage()]);
    }
    $conn = null;
}

// Add contact info
function addContactInfo() {
    $conn = getDBConnection();
    $data = json_decode(file_get_contents('php://input'), true);
    
    try {
        if (isPDO($conn)) {
            $stmt = $conn->prepare("INSERT INTO contact_info (type, value, icon) VALUES (?, ?, ?)");
            $stmt->execute([$data['type'], $data['value'], $data['icon']]);
        } else {
            $sql = "INSERT INTO contact_info (type, value, icon) VALUES ('{$data['type']}', '{$data['value']}', '{$data['icon']}')";
            $conn->query($sql);
        }
        echo json_encode(["success" => "Contact info added successfully"]);
    } catch (Exception $e) {
        echo json_encode(["error" => "Add failed: " . $e->getMessage()]);
    }
    $conn = null;
}

// Update contact info
function updateContactInfo($id) {
    $conn = getDBConnection();
    $data = json_decode(file_get_contents('php://input'), true);
    
    try {
        if (isPDO($conn)) {
            $stmt = $conn->prepare("UPDATE contact_info SET type=?, value=?, icon=? WHERE id=?");
            $stmt->execute([$data['type'], $data['value'], $data['icon'], $id]);
        } else {
            $sql = "UPDATE contact_info SET type='{$data['type']}', value='{$data['value']}', icon='{$data['icon']}' WHERE id=$id";
            $conn->query($sql);
        }
        echo json_encode(["success" => "Contact info updated successfully"]);
    } catch (Exception $e) {
        echo json_encode(["error" => "Update failed: " . $e->getMessage()]);
    }
    $conn = null;
}

// Delete contact info
function deleteContactInfo($id) {
    $conn = getDBConnection();
    
    try {
        if (isPDO($conn)) {
            $stmt = $conn->prepare("DELETE FROM contact_info WHERE id=?");
            $stmt->execute([$id]);
        } else {
            $sql = "DELETE FROM contact_info WHERE id=$id";
            $conn->query($sql);
        }
        echo json_encode(["success" => "Contact info deleted successfully"]);
    } catch (Exception $e) {
        echo json_encode(["error" => "Delete failed: " . $e->getMessage()]);
    }
    $conn = null;
}

// Get education list
function getEducation() {
    $conn = getDBConnection();
    try {
        if (isPDO($conn)) {
            $stmt = $conn->query("SELECT * FROM education ORDER BY start_year DESC");
            $education = $stmt->fetchAll();
        } else {
            $result = $conn->query("SELECT * FROM education ORDER BY start_year DESC");
            $education = [];
            while ($row = $result->fetch_assoc()) {
                $education[] = $row;
            }
        }
        echo json_encode($education);
    } catch (Exception $e) {
        echo json_encode(["error" => "Failed to get education: " . $e->getMessage()]);
    }
    $conn = null;
}

// Add education
function addEducation() {
    $conn = getDBConnection();
    $data = json_decode(file_get_contents('php://input'), true);
    
    try {
        if (isPDO($conn)) {
            $stmt = $conn->prepare("INSERT INTO education (institution, degree, major, start_year, end_year, courses, description) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$data['institution'], $data['degree'], $data['major'], $data['start_year'], $data['end_year'], $data['courses'], $data['description']]);
        } else {
            $sql = "INSERT INTO education (institution, degree, major, start_year, end_year, courses, description) VALUES ('{$data['institution']}', '{$data['degree']}', '{$data['major']}', '{$data['start_year']}', '{$data['end_year']}', '{$data['courses']}', '{$data['description']}')";
            $conn->query($sql);
        }
        echo json_encode(["success" => "Education record added successfully"]);
    } catch (Exception $e) {
        echo json_encode(["error" => "Add failed: " . $e->getMessage()]);
    }
    $conn = null;
}

// Update education
function updateEducation($id) {
    $conn = getDBConnection();
    $data = json_decode(file_get_contents('php://input'), true);
    
    try {
        if (isPDO($conn)) {
            $stmt = $conn->prepare("UPDATE education SET institution=?, degree=?, major=?, start_year=?, end_year=?, courses=?, description=? WHERE id=?");
            $stmt->execute([$data['institution'], $data['degree'], $data['major'], $data['start_year'], $data['end_year'], $data['courses'], $data['description'], $id]);
        } else {
            $sql = "UPDATE education SET institution='{$data['institution']}', degree='{$data['degree']}', major='{$data['major']}', start_year='{$data['start_year']}', end_year='{$data['end_year']}', courses='{$data['courses']}', description='{$data['description']}' WHERE id=$id";
            $conn->query($sql);
        }
        echo json_encode(["success" => "Education record updated successfully"]);
    } catch (Exception $e) {
        echo json_encode(["error" => "Update failed: " . $e->getMessage()]);
    }
    $conn = null;
}

// Delete education
function deleteEducation($id) {
    $conn = getDBConnection();
    
    try {
        if (isPDO($conn)) {
            $stmt = $conn->prepare("DELETE FROM education WHERE id=?");
            $stmt->execute([$id]);
        } else {
            $sql = "DELETE FROM education WHERE id=$id";
            $conn->query($sql);
        }
        echo json_encode(["success" => "Education record deleted successfully"]);
    } catch (Exception $e) {
        echo json_encode(["error" => "Delete failed: " . $e->getMessage()]);
    }
    $conn = null;
}

// Get stats
function getStats() {
    $conn = getDBConnection();
    try {
        // Get skills count
        if (isPDO($conn)) {
            $stmt = $conn->query("SELECT COUNT(*) as count FROM skills");
            $skills_count = $stmt->fetch()['count'];
        } else {
            $result = $conn->query("SELECT COUNT(*) as count FROM skills");
            $skills_count = $result->fetch_assoc()['count'];
        }
        
        // Get projects count
        if (isPDO($conn)) {
            $stmt = $conn->query("SELECT COUNT(*) as count FROM projects");
            $projects_count = $stmt->fetch()['count'];
        } else {
            $result = $conn->query("SELECT COUNT(*) as count FROM projects");
            $projects_count = $result->fetch_assoc()['count'];
        }
        
        // Get experiences count
        if (isPDO($conn)) {
            $stmt = $conn->query("SELECT COUNT(*) as count FROM experiences");
            $experiences_count = $stmt->fetch()['count'];
        } else {
            $result = $conn->query("SELECT COUNT(*) as count FROM experiences");
            $experiences_count = $result->fetch_assoc()['count'];
        }
        
        // Get education count
        if (isPDO($conn)) {
            $stmt = $conn->query("SELECT COUNT(*) as count FROM education");
            $education_count = $stmt->fetch()['count'];
        } else {
            $result = $conn->query("SELECT COUNT(*) as count FROM education");
            $education_count = $result->fetch_assoc()['count'];
        }
        
        $stats = [
            'experience' => $experiences_count,
            'projects' => $projects_count,
            'skills' => $skills_count,
            'clients' => 10 // Default value
        ];
        
        echo json_encode($stats);
    } catch (Exception $e) {
        echo json_encode(["error" => "Failed to get stats: " . $e->getMessage()]);
    }
    $conn = null;
}
?>