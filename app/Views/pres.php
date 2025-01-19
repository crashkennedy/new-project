<style>
    .carousel-item>img{
        object-fit:cover !important;
    }
    #carouselExampleControls .carousel-inner{
        height:35em !important;
    }
    

.container_pres {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    margin-bottom: 20px;
}

input[type="file"] {
    margin-bottom: 10px;
}

button {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}

#message {
    margin-top: 20px;
}

</style>
<div class="container">
    <div class="content">
        <div id="carouselExampleControls" class="carousel slide bg-dark" data-ride="carousel">
            <div class="carousel-inner">
                <?php 
                
                    $upload_path = "uploads/banner";
                    if(is_dir(base_app.$upload_path)): 
                    $file= scandir(base_app.$upload_path);
                    $_i = 0;
                        foreach($file as $img):
                            if(in_array($img,array('.','..')))
                                continue;
                    $_i++;
                        
                ?>
                <?php require_once('func.php');?>
                <div class="carousel-item h-100 <?php echo $_i == 1 ? "active" : '' ?>">
                    <img src="<?php echo validate_image($upload_path.'/'.$img) ?>" class="d-block w-100  h-100" alt="<?php echo $img ?>">
                </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="row mt-lg-n4 mt-md-n4 justify-content-center">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="card rounded-0">
                <div class="card-body">
                    <h3 class="text-center"><b>Manage Prescription</b></h3>
                    <center><hr style="height:2px;width:5em;opacity:1" class="bg-danger"></center>
                     <div class=".container_pres ">
                    <form id="uploadForm" action="upload.php" method="POST" enctype="multipart/form-data">
                        <input type="file" name="file" id="file" required>
                        <button type="submit">Upload</button>
                    </form>
                    <br>
                    <img src="uploads/R.png" width="100%" height="300px;">
        <div id="message"></div>
    </div>
               
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
    })
    
</script>
