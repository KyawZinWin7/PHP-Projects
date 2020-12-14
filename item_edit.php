  
<?php 
    require('backendheader.php');
    require('db_connect.php');

    // get id from address bar
    $id = $_GET['cid'];
    // var_dump($id);

    // draw out the query from db
    $sql = "SELECT * FROM items WHERE id = :value1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':value1', $id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // var_dump($row);
?>
      

        <div class="app-title">
                <div>
                    <h1> <i class="icofont-list"></i> Edit Item Form </h1>
                </div>
                <ul class="app-breadcrumb breadcrumb side">
                    <a href="item_list.php" class="btn btn-outline-primary">
                        <i class="icofont-double-left"></i>
                    </a>
                </ul>
        </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <div class="tile-body">
                            
                            <form action="item_update.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <input type="hidden" name="oldphoto" value="<?= $row['photo'] ?>">

                            <div class="form-group row">
                                    <label for="photo_id" class="col-sm-2 col-form-label"> Photo </label>
                                <div class="col-sm-10">

                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                             <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Old Photo</a>
                                             <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">New Photo </a>
                                        </div>
                                    </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <img src="<?= $row['photo'] ?>" class="img-fluid">
                                    </div>
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        
                                        <input type="file" id="photo_id" name="newphoto">
                                        
                                    </div>
                                </div>

                            </div>
                        </div>
                                <div class="form-group row">
                                    <label for="name_id" class="col-sm-2 col-form-label"> Name </label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="name_id" name="name" value="<?= $row['name'] ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <label for="profile" class="col-sm-2 col-form-label"> Price </label>
                                    <div class="col-sm-10">

                                             <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link" id="oldprofile-tab" data-toggle="tab" href="#oldprofile" role="tab" aria-controls="oldprofile"  aria-selected="true"> Unit Price </a>
                                                </li>
      
                                                <li class="nav-item">
                                                    <a class="nav-link" id="newprofile-tab" data-toggle="tab" href="#newprofile" role="tab" aria-controls="newprofile" aria-selected="false"> Discount </a>
                                                </li>
                                            </ul>
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane" id="oldprofile" role="tabpanel" aria-labelledby="oldprofile-tab">
                                                <input type="text" name="price" class="form-control" value="<?= $row['price'] ?>">
                                            </div>
                            
                                            <div class="tab-pane" id="newprofile" role="tabpanel" aria-labelledby="newprofile-tab">
                                                <input type="text"  id="profile" name="discount" class="form-control" value="<?= $row['discount'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <label for="description" class="col-sm-2 col-form-label"> Description </label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="5" name="description" value=""><?= $row['description'] ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="codeno_id" class="col-sm-2 col-form-label"> Codeno </label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="codeno_id" name="codeno" value="<?= $row['codeno'] ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <label for="description" class="col-sm-2 col-form-label"> Choose Brand </label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="c_brand">
                                            <?php 
                                                $sql = "SELECT * FROM brands";
                                                $stmt = $conn->prepare($sql);
                                                $stmt->execute();

                                                $brands = $stmt->fetchAll();

                                                $i = 1;

                                                foreach ($brands as $brand) {
                                                    
                                                    $id = $brand['id'];
                                                    $name = $brand['name'];
                                                

                                            ?>
                                            <option value="<?= $id ?>" <?php  if ($row['brand_id']== $id) {
                                                
                                                echo "selected";
                                            }?> > 
                                                <?= $name ?>
                                            </option>

                                        <?php } ?>
                                    

                                     </select>
                                    </div>
                                </div>
                                
                                 <div class="form-group row">
                                        <label for="description" class="col-sm-2 col-form-label"> Subcategory </label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="c_subcategory">
                                            <?php 
                                                $sql = "SELECT * FROM subcategories";
                                                $stmt = $conn->prepare($sql);
                                                $stmt->execute();
                                                $subcategories = $stmt->fetchAll();
                                                $i = 1;
                                                foreach ($subcategories as $subcategory) {
                                                    $id = $subcategory['id'];
                                                    $name = $subcategory['name'];
                                                

                                            ?>
                                            <option value="<?= $id ?>"<?php if ($row['subcategory_id']== $id) {
                                                
                                                echo "selected";
                                            } ?>>
                                                <?= $name ?>
                                            </option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="icofont-save"></i>
                                            Save
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
<?php
    
    require('backendfooter.php');

?>