<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once '../../../controllers/RolController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rolController = new RolController();

    // Get the submitted access data
    $accessData = $_POST['access'] ?? [];

    // Fetch current accesses from the database
    $currentAccess = $rolController->obtenerAccesosPorRolModulo(); // Array actual de accesos

    // Convert current access data to a simple array for easier comparison
    $currentAccessArray = [];
    foreach ($currentAccess as $access) {
        $currentAccessArray[] = $access['id_rol'] . '-' . $access['id_modulo'];
    }

    // New accesses to be added
    $newAccesses = [];
    foreach ($accessData as $id_rol => $modules) {
        foreach ($modules as $id_modulo => $value) {
            $key = $id_rol . '-' . $id_modulo;
            if (!in_array($key, $currentAccessArray)) {
                $newAccesses[] = ['id_rol' => $id_rol, 'id_modulo' => $id_modulo];
            }
        }
    }

    // Accesses to be removed
    $accessToRemove = [];
    foreach ($currentAccess as $access) {
        $key = $access['id_rol'] . '-' . $access['id_modulo'];
        if (!isset($accessData[$access['id_rol']][$access['id_modulo']])) {
            $accessToRemove[] = ['id_rol' => $access['id_rol'], 'id_modulo' => $access['id_modulo']];
        }
    }

    // Add new accesses
    foreach ($newAccesses as $access) {
        $rolController->asignarModuloARol($access['id_rol'], $access['id_modulo']);
    }

    // Remove unchecked accesses
    foreach ($accessToRemove as $access) {
        $rolController->removerModuloDeRol($access['id_rol'], $access['id_modulo']);
    }

    // Redirect back to the access page with a success message
    header("Location: accesos.php?success=1");
    exit();
}
?>
