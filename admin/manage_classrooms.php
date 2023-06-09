 <?php
    require('top.inc.php');
    isAdmin();

    $building_id = '';
    $classroom_name = '';
    $msg = '';

    if (isset($_GET['id']) && $_GET['id'] != '') {
        $id = get_safe_value($con, $_GET['id']);
        $res = mysqli_query($con, "select * from classrooms where id='$id'");
        $check = mysqli_num_rows($res);
        if ($check > 0) {
            $row = mysqli_fetch_assoc($res);
            $building_id = $row['building_id'];
            $classroom_name = $row['name'];
        } else {
            header('location:classrooms.php');
            die();
        }
    }

    if (isset($_POST['submit'])) {
        $building_id = get_safe_value($con, $_POST['building_id']);
        $classroom_name = get_safe_value($con, $_POST['classroom_name']);
        if (isset($_GET['id']) && $_GET['id'] != '') {
            mysqli_query($con, "update classrooms set building_id='$building_id', name='$classroom_name' where id='$id'");
            echo "<script>window.location.href='classrooms.php'</script>";
        } else {
            $res = mysqli_query($con, "select * from classrooms where name='$classroom_name' and building_id='$building_id'");
            $check = mysqli_num_rows($res);
            if ($check > 0) {
                $msg = "Classroom ALREADY EXIST in this building";
            } else {
                mysqli_query($con, "insert into classrooms(`building_id`, `name`) values('$building_id', '$classroom_name')");
                echo "<script>window.location.href='classrooms.php'</script>";
                die();
            }
        }
    }
    ?>

 <div class="content pb-0" style="text-align:center">
     <div class="orders">
         <div class="row">
             <div class="col-xl-12">
                 <div class="card">
                     <div class="card-body">
                         <h4 class="box-title"> القاعات الدراسية </h4>
                     </div>
                     <div class="card-body--">
                         <div class="table-stats order-table ov-h">
                             <form method="POST" action="" class="mx-2">
                                 <input type="hidden" name="id" value="<?php echo $id; ?>">
                                 <div class="form-group row">
                                     <label for="building_id" class="col-sm-2 col-form-label">اسم المبنى:</label>
                                     <div class="col-sm-10">
                                         <select id="building_id" name="building_id" required class="form-control">
                                             <option value="">اختر المبنى</option>
                                             <?php
                                                $building_sql = "SELECT * FROM buildings";
                                                $buildings_result = mysqli_query($con, $building_sql);
                                                while ($building_row = mysqli_fetch_assoc($buildings_result)) {
                                                    $buildings_id = $building_row['id'];
                                                    $building_name = $building_row['name'];
                                                    echo "<option value='$buildings_id' " . ($buildings_id == $building_id ? 'selected' : '') . ">$building_name</option>";
                                                }
                                                ?>
                                         </select>
                                     </div>
                                 </div>
                                 <div class="form-group row">
                                     <label for="classroom_name" class="col-sm-2 col-form-label"> اسم القاعة الدارسية:</label>
                                     <div class="col-sm-10">
                                         <input type="text" id="classroom_name" name="classroom_name" value="<?php echo $classroom_name; ?>" required class="form-control">
                                     </div>
                                 </div>
                                 <div class="form-group my-3">
                                     <button type="submit" name="submit" class="btn btn-primary float-start my-3"> تحديث البيانات  </button>
                                 </div>
                             </form>
                         </div>
                         <?= $msg ?>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <?php
    require('footer.inc.php');
    ?>