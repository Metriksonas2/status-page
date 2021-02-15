<?php require_once(__DIR__ . "/bootstrap.php"); ?>

<?php 

$serviceContainer = new ServiceContainer($configuration);
$pdo = $serviceContainer->getPDO();
$studentsLoader = $serviceContainer->getStudentsLoader();
$students = $studentsLoader->getStudents();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Status Page</title>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Add Student</h2>
        <div class="row">
            <div class="text-center signup-form my-form col-md-6">
                <form action="includes/add_student.inc.php" method="post">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input class="form-control" type="text" name="first_name" id="first_name" required="required">
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input class="form-control" type="text" name="last_name" id="last_name" required="required">
                    </div>

                    <div class="form-group">
                        <input class="form-control btn btn-lg btn-primary" style="" type="submit" name="submit" value="Add Student">
                    </div>
                </form>
            </div>
        </div>

        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>Student</th>
                    <th>Group</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($students as $student): ?>
                    <tr>
                        <td><?php echo strval($student); ?></td>
                        <td><?php echo $student->getGroup(); ?></td>
                        <td>Delete</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>