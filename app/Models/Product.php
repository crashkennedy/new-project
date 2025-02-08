<?php

namespace App\Models;

use DateTime;
use PDO;
use PDOException;

class Product
{
    // private int $id;
    // private int $catergory_id;
    // private string $name;
    // private string $description;
    // private string $image_path;
    // private string $dose;
    // private float  $price;
    // private bool $status;
    // private bool $delete_flag;
    // private DateTime $date_created;
    // private DateTime $date_updated;

    public function __construct(
        private PDO $conn
    ){}

    public function createProduct(array $data){
         $query =  "INSERT INTO product_list (
		 category_id,
		 brand,
		 name,
		 description,
		 dose,
		 price,
		 image_path,
		 status,
		 delete_flag,
		 date_created,
		 date_updated)
		 VALUES (
		 :category_id,
		 :brand,
		 :name,
		 :description,
		 :dose,
		 :price,
		 :image_path,
		 :status,
		 :delete_flag,
		 :date_created,
		 :date_updated)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindvalue(":category_id", $data['category_id']);
		$stmt->bindvalue(":brand", $data['brand']);
		$stmt->bindvalue(":name", $data['name']);
		$stmt->bindvalue(":description", $data['description']);
		$stmt->bindvalue(":dose", $data['dose']);
		$stmt->bindvalue(":price", $data['price']);
		$stmt->bindvalue(":image_path", $data['image_path']);
		$stmt->bindvalue(":status", $data['status']);
		$stmt->bindvalue(":delete_flag", $data['delete_flag']);
		$stmt->bindvalue(":date_created", $data['date_created']);
		$stmt->bindvalue(":date_updated", $data['date_updated']);
		$stmt->execute();
    }

	public function getProductById($id, $conn){
		$query = "SELECT * FROM product_list where id = :id";
		$stmt = $conn->prepare($query);
		$stmt->bindvalue(":id", $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}


	public function deleteProduct($id){
		$query = "DELETE FROM product_list WHERE id = :id";
		$stmt = $this->conn->prepare($query);
		$stmt->bindValue(":id", $id);
		$stmt->execute();
		// try {
		// 	if($stmt->execute()){
		// 		$resp['status'] = 'success';
		// 		$this->settings->set_flashdata('success'," Product successfully deleted.");
		// 	} else {
		// 		$resp['status'] = 'failed';
		// 		$resp['error'] = $stmt->errorInfo()[2];
		// 	}
		// } catch (\PDOException $e) {
		// 	$resp['status'] = 'failed';
		// 	$resp['error'] = $e->getMessage();
		// }
		// return json_encode($resp);
	}


	// function delete_product(){
	// 	extract($_POST);
	// 	$del = $this->conn->query("DELETE FROM `product_list` where id = '{$id}'");
	// 	if($del){
	// 		$resp['status'] = 'success';
	// 		$this->settings->set_flashdata('success'," Product successfully deleted.");
	// 	}else{
	// 		$resp['status'] = 'failed';
	// 		$resp['error'] = $this->conn->error;
	// 	}
	// 	return json_encode($resp);

	// }

	public static function getProductInStock(PDO $conn,  $limit = 4, ) {
		$query = "SELECT *,
			(COALESCE((SELECT SUM(quantity) FROM stock_list WHERE product_id = product_list.id AND (expiration IS NULL OR date(expiration) > :current_date)), 0) -
			COALESCE((SELECT SUM(quantity) FROM order_items WHERE product_id = product_list.id), 0)) AS available
			FROM product_list
			WHERE (COALESCE((SELECT SUM(quantity) FROM stock_list WHERE product_id = product_list.id AND (expiration IS NULL OR date(expiration) > :current_date)), 0) -
			COALESCE((SELECT SUM(quantity) FROM order_items WHERE product_id = product_list.id), 0)) > 0
			ORDER BY RANDOM()
			LIMIT :limit";

		try {
			$stmt = $conn->prepare($query);
			$stmt->bindValue(':current_date', date("Y-m-d"), PDO::PARAM_STR);
			$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			// Log the error or handle it appropriately
			error_log("Error fetching in-stock products: " . $e->getMessage());
			return [];
		}
	}

}