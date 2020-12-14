  
<?php
    require('backendheader.php');
    require('db_connect.php');
?>


  <div class="app-title">
                <div>
                    <h1> <i class="icofont-list"></i> Items </h1>
                </div>
                <ul class="app-breadcrumb breadcrumb side">
                    <a href="item_new.php" class="btn btn-outline-primary">
                        <i class="icofont-plus"></i>
                    </a>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <div class="tile-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="sampleTable">
                                    <thead>
                                        <tr>
                                          <th>#</th>
                                          <th>Name</th>
                                          <th>Brand</th>
                                          <th>Price</th>
                                          <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php
                                            $sql = "SELECT items.*, brands.name as brandsname FROM items LEFT JOIN brands ON items.brand_id = brands.id";
                                            $stmt = $conn->prepare($sql);

                                            $stmt->execute();

                                            $rows = $stmt->fetchAll();
                                            // var_dump($rows);

                                            $i = 1;
                                            foreach ($rows as $row) {
                                                // var_dump($row);
                                                $id=$row['id'];
                                                
                                                 $name=$row['name'];
                                                 $brandsname=$row['brandsname'];
                                                 $price=$row['price'];
                                                $discount=$row['discount'];
                                                $photo = $row['photo'];

                                        ?>
                                        <tr>
                                            <td><?= $i++?></td>
                                            <td> <img src="<?= $photo  ?>" width="50px" height="50px"> <?= $name ?></td>
                                            <td><?= $brandsname ?></td>
                                            <td><?= $price ?><br><?= $discount ?></td>
                                        
                                             <td>
                                                <a href="item_edit.php?cid=<?= $id ?>" class="btn btn-warning">
                                                    <i class="icofont-ui-settings"></i>
                                                </a>

                                                <form class="d-inline-block" onsubmit="return confirm('Are you sure want to delete?')" method="POST" action="item_delete.php">
                                                <input type="hidden" name="id" value="<?= $id ?>">
                                                <button class="btn btn-outline-danger">
                                                    <i class="icofont-close"></i>
                                                </button>
                                                    
                                                </form>
                                            </td>

                                        </tr>
                                    <?php } ?>

                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



<?php

        require('backendfooter.php');

?>