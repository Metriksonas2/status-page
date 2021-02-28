<h2 class="text-center mt-2 my-font"> Project Students</h2>

<div class="row">
    <?php if($studentsLoader->getProjectStudentsCount() == 0): ?>
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th style="width: 44%">Student</th>
                    <th style="width: 28%">Group</th>
                    <th style="width: 28%">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
            </tbody>
        </table>
        <h3 class="col-md-12 message">Add students to your project!</h3>
    <?php else: ?>
        <table class="table mt-2">
            <thead class="thead-light">
                <tr>
                    <th style="width: 44%">Student</th>
                    <th style="width: 30%">Group</th>
                    <th style="width: 26%">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($students as $student): ?>
                    <?php 
                        $studentId = $student->getId();
                        $studentsGroup = $student->getGroup();
                        $studentGroupId = $student->getGroup_id();
                    ?>
                    <tr>
                        <td><?php echo strval($student); ?></td>
                        <td><?php echo $studentsGroup; ?></td>
                        <td>
                            <form action="includes/delete_student.inc.php" method="post" id="student_<?php echo $studentId; ?>">
                                <a role="button" href="javascript:void(0)" onclick="document.getElementById('student_<?php echo $studentId; ?>').submit()">Delete</a>
                                <input type="hidden" name="student_id" value="<?php echo $studentId; ?>" />
                                <input type="hidden" name="project_id" value="<?php echo $project_id; ?>" />
                                <input type="hidden" name="group_id" value="<?php echo $studentGroupId; ?>" />
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>