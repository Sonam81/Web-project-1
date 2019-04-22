<?php
/**
 * creating class TableGenerator 
 */
class TableGenerator
{
	
	public $heading;
	public $rows = [];

	//setHeadings function to set headings
	public function setHeadings($headings){
			$this->headings = $headings;
		}

		//setHeadings function to set headings
		public function setRows($rows){
			$this->rows[] = $rows;
		}
		//table of allProduct
		public function getHTMLProduct(){
			$html = '<table border="2">';
				$html .='<tr>';
					foreach ($this->headings as $headings) {
						$html .= '<th>' . $headings . '</th>';
					}
					$html .= '</tr>';
					foreach ($this->rows as $row) {
						$html .= '<tr>';
						foreach ($row as $key=>$cell) {
							if(!is_numeric($key))
							$html .= '<td>' . $cell . '</td>';
							}
							$html .= '<td><a href="editProducts.php?editId='.$row['product_code'].'">EDIT</a>'.' | <a href="allproducts.php?delId='.$row['product_code'].'">DELETE</a></td>';
							
						$html .= '</tr>';

					}
			$html .= '</table>';
			return $html;
		}
		//table of allusers
		public function getHTMLUser(){
			$html = '<table border="2">';
				$html .='<tr>';
					foreach ($this->headings as $headings) {
						$html .= '<th>' . $headings . '</th>';
					}
					$html .= '</tr>';
					foreach ($this->rows as $row) {
						$html .= '<tr>';
						foreach ($row as $key=>$cell) {
							if(!is_numeric($key))
							$html .= '<td>' . $cell . '</td>';
							}
							$html .= '<td><a href="editUsers.php?editId='.$row['user_id'].'">EDIT</a>'.' | <a href="allusers.php?delId='.$row['user_id'].'">DELETE</a></td>';
							
						$html .= '</tr>';

					}
			$html .= '</table>';
			return $html;
		}
		//table of alladmins
		public function getHTMLAdmin(){
			$html = '<table border="2">';
				$html .='<tr>';
					foreach ($this->headings as $headings) {
						$html .= '<th>' . $headings . '</th>';
					}
					$html .= '</tr>';
					foreach ($this->rows as $row) {
						$html .= '<tr>';
						foreach ($row as $key=>$cell) {
							if(!is_numeric($key))
							$html .= '<td>' . $cell . '</td>';
							}
							$html .= '<td><a href="editAdmins.php?editId='.$row['id'].'">EDIT</a>'.' | <a href="alladmins.php?delId='.$row['id'].'">DELETE</a></td>';
							
						$html .= '</tr>';

					}
			$html .= '</table>';
			return $html;
		}
		//table of allcategories
		public function getHTMLCategory(){
			$html = '<table border="2">';
				$html .='<tr>';
					foreach ($this->headings as $headings) {
						$html .= '<th>' . $headings . '</th>';
					}
					$html .= '</tr>';
					foreach ($this->rows as $row) {
						$html .= '<tr>';
						foreach ($row as $key=>$cell) {
							if(!is_numeric($key))
							$html .= '<td>' . $cell . '</td>';
							}
							$html .= '<td><a href="allcategories.php?delId='.$row['categorie_id'].'">DELETE</a></td>';
							
						$html .= '</tr>';

					}
			$html .= '</table>';
			return $html;
		}

	
}
?>