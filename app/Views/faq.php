<style>
    .carousel-item>img{
        object-fit:cover !important;
    }
    #carouselExampleControls .carousel-inner{
        height:35em !important;
    }
    .faq-container {
    max-width: 800px;
    margin: 50px auto;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    color: #333;
}

.faq-item {
    margin: 10px 0;
    border-bottom: 1px solid #ddd;
}

.faq-question {
    padding: 15px;
    cursor: pointer;
    font-weight: bold;
    background: #f7f7f7;
    transition: background 0.3s ease;
}

.faq-question:hover {
    background: #e7e7e7;
}

.faq-answer {
    display: none;
    padding: 15px;
    background: #fafafa;
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
                    <h3 class="text-center"><b>Frequently Asked Questions</b></h3>
                    <center><hr style="height:2px;width:5em;opacity:1" class="bg-danger"></center>
                                    <div class="faq-container">
                        <div class="faq-item">
                            <div class="faq-question">How do I place an order on your website?</div>
                            <div class="faq-answer">Add items to your cart, proceed to checkout, enter shipping info, choose payment method, and confirm your order.</div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-question">What payment methods do you accept?</div>
                            <div class="faq-answer">We accept major cards, and bank transfers.</div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-question">How do you ensure the privacy and security of my personal information?</div>
                            <div class="faq-answer">We use SSL encryption and comply with data protection regulations to keep your information safe.</div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-question">What is your return and refund policy?</div>
                            <div class="faq-answer">Return unopened items within 30 days for a refund or exchange. Contact customer service to initiate a return.</div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-question">How long will it take to receive my order?</div>
                            <div class="faq-answer">Orders are processed in 1-2 business days. Standard shipping takes 3-7 business days, with expedited options available.</div>
                        </div>
                    </div>
                    <script>
                    
                    document.addEventListener("DOMContentLoaded", function() {
    const faqItems = document.querySelectorAll(".faq-item");

    faqItems.forEach(item => {
        const question = item.querySelector(".faq-question");
        question.addEventListener("click", () => {
            const answer = item.querySelector(".faq-answer");
            const isVisible = answer.style.display === "block";

            // Hide all answers
            document.querySelectorAll(".faq-answer").forEach(answer => answer.style.display = "none");

            // Toggle current answer
            answer.style.display = isVisible ? "none" : "block";
        });
    });
});

                    
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
    })
</script>
