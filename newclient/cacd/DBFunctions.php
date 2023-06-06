<?php

class DBFunction
{
	
	function mysql_funX_connect()
	{
		@mysql_connect("localhost","root","") or die("Server is Not Connected");
		@mysql_select_db("healthinhand_db") or die("Invalid Database");
	}
	
	
//This Grid Function Created By Priyank Patel

	function mysql_funX_GridView($tblname,$colname,$ColID,$CurentPage,$EditPage,$cssclass)
	{
		try
		{
		  //Call Same Class Function Using "$this" Key Word
		  //This is Connection Of DB
		  $this->mysql_funX_connect();
		  
		  //Delete BTN Coding
		  //
			if(isset($_REQUEST['Delete']))
		  {
			 $DeleteQuery= mysql_query("Delete From ".$tblname." where ".$ColID."=".$_REQUEST['Delete']) or die("Delete Query Error");
			 echo("<label id='lblAlert' class='label label-success' style='display: inline-block;width: 100%;padding: 0.5em 0.7em 0.5em;'>Succefully Delete Your Data.</label>");
			
			 //header("Refresh:0;'$PageName'");
		  }
		  
		  //Delete BTN Coding END
		  
		  $query = 'select '.$colname.' from '.$tblname." Order By ".$ColID." DESC";
		  $result = mysql_query($query) or die("Query Error");
		  
		  if (!$result) 
		  {
			  $message = 'ERROR:' . mysql_error();
			  return $message;
		  }
		  else
		  {
			  if(mysql_num_rows($result) > 0)
			  {
				$i = 0;
				echo "<html><body><table class='$cssclass'><tr>";
					if($EditPage != "#")
					{
						echo "<th style='width:60px;text-align: center;'>Edit</th>";
					}
				if($CurentPage != "#")
					{
				echo "<th  style='width:60px;text-align: center;'>Delete</th>";
					}
				while ($i < mysql_num_fields($result))
				{
					$meta = mysql_fetch_field($result, $i);
					echo '<th>' . $meta->name . '</th>';
					$i = $i + 1;
				}
				echo '</tr>';
				
				$i = 0;
				while ($row = mysql_fetch_assoc($result)) 
				{
					echo '<tr>';
					$count = count($row);
					$y = 0;
					
					if($EditPage != "#")
					{
						echo "
						<td  style='width:60px;text-align: center;'>
					<a href='".$EditPage."&id=".$row[$ColID]."'><i class='fa fa-pencil'></i></a>
					</td>
						";
					}
					if($CurentPage != "#")
					{
					echo "<td  style='width:60px;text-align: center;'>
					<a href='".$CurentPage."&Delete=".$row[$ColID]."' OnClick=\"return confirm('Are You Sure Want to Delete?');\"><i class='fa fa-trash'></i></a>
					</td>";
					}
					while ($y < $count)
					{
						$c_row = current($row);
						echo '<td>' . $c_row . '</td>';
						next($row);
						$y = $y + 1;
					}
					echo '</tr>';
					$i = $i + 1;
				}
				echo '</table></body></html>';
				mysql_free_result($result);
			  }
			  else
			  {
				  echo(" <div class='text-center'><label id='lblAlert' class='label label-danger'>There is No Data in Our Database.</label></div>");
			  }
		  }
		  mysql_close();	
		}
		catch(Exception $e)
		{
			$e = 'ERROR:' . mysql_error();
			mysql_close();
			return $e;
		}
		
	}
	
	//This DataList Function Created By Priyank Patel
	function mysql_funX_DataList($tblname,$col,$id,$limit,$itemtemplet, $attr)
	{
		//Call Same Class Function Using "$this" Key Word
		//This is Connection Of DB
		$this->mysql_funX_connect();
		
		 $row = $this->mysql_funX_GetDataSet("Select ".$col." from ".$tblname);
		$count = count($row);
		$total_pages = ceil($count / $limit);
		//echo $count."<br>".$total_pages."<br>";
		echo " <table ".$attr.">";
		for ($i=1; $i<=$total_pages; $i++) { 
			$start_from = ($i-1) * $limit; 
			
				echo "<tr>";
			$templet = "<td>".$itemtemplet."</td>";
			echo $this->mysql_funX_Repeter("Select ".$col." from ".$tblname." ORDER BY ".$id." ASC LIMIT $start_from, $limit",$templet);
			echo " </tr>";
			
		}
		echo "</table>";
		
		
	}
	
	//This Repeter Function Created By Priyank Patel
	function mysql_funX_Repeter($query,$itemtemplet)
	{
		$this->mysql_funX_connect();
		
		$result = mysql_query($query) or die("Repeter Query Error.");
		if (!$result) 
		{
			$message = 'ERROR:' . mysql_error();
			return $message;
		}
		else
		{
			preg_match_all('/{([^}]*)}/', $itemtemplet, $matches);
			$select = '';
			while($row = mysql_fetch_assoc($result)){
				$aux = $itemtemplet;
				
				for($i = 0; $i < count($matches[0]); $i++){
					$aux = str_replace($matches[0][$i], $row[$matches[1][$i]],$aux);
				}
				$select .= $aux."\n";
			}
			mysql_close();
			return $select;
		}
	}
	
	//Function For Execute Query
	function mysql_funX_ExecuteNonQuery($query)
	{
		try
		{
			$this->mysql_funX_connect();
			mysql_query($query);
			mysql_close();
			return "0";
		}
		catch(Exception $e)
		{
			$e = 'ERROR:' . mysql_error();
			mysql_close();
			return $e;
		}
	}
	
	
	//Function For GetDataSet
	function mysql_funX_GetDataSet($query)
	{
		$this->mysql_funX_connect();
		$qry = mysql_query($query);
		$result=NULL;
		while($row=mysql_fetch_array($qry)) 
		{
		  $result[] = $row;
		}
		return $result;
		mysql_close();
		
	}
	
	//Function For ExecuteReader
	
	function mysql_funX_ExecuteReader($query)
	{
		$this->mysql_funX_connect();
		$qry = mysql_query($query);
		if(mysql_num_rows($qry) > 0)
		{
			mysql_close();
			return 1;
			
		}
		else
		{
			mysql_close();
			return 0;
		}
		
		
	}
	//Function For FillDropdownList
	function mysql_funX_FillDropDownList($DropDownList,$TableName,$DataTextFild,$DataValueFild,$DropSelected,$Caption,$CssClsss)
	{
		$select="";
		$this->mysql_funX_connect();
		$query= "Select ".$DataValueFild.",".$DataTextFild." from ".$TableName;
		$result = mysql_query($query) or die("FillDropDownlist Query Error");
		if (!$result) 
		{
			$message = 'ERROR:' . mysql_error();
			return $message;
		}
		else
		{
			echo("<select id='".$DropDownList."' required aria-required='true' name='".$DropDownList."'  class='$CssClsss'>
			<option value='' selected>---Select ".$Caption."----</option>");
			while ($row = mysql_fetch_array($result)) 
			{
				if($row[0] == $DropSelected)
				{
					$select="selected";
					echo("<option value='$row[0]' $select>$row[1]</option>");
				}
				else
				{
					echo("<option value='$row[0]'>$row[1]</option>");
				}
			}
			echo("</select>");
		}
		mysql_close();
	}
	//Function For MaxId
	function mysql_funX_MaxId($tblname,$colID)
	{
		$this->mysql_funX_connect();
		$query= "Select MAX(".$colID.") from ".$tblname." order by ".$colID." DESC";
		$result = mysql_query($query) or die("MaxId Query Error");
		if (!$result) 
		{
			$message = 'ERROR:' . mysql_error();
			return $message;
		}
		else
		{
			while ($row = mysql_fetch_array($result)) 
			{
				if($row[0] == "")
				{
					return 1;
				}
				else
				{
					return $row[0] + 1;
				}
			}
			
		}
		mysql_close();
	}
	
	//Unknown Not in Use Function For DataById
	function mysql_funX_ExecuteReaderData($tblname,$colID,$IDValue)
	{
		try
		{
			$this->mysql_funX_connect();
			$query= "Select * from ".$tblname." where ".$colID." = ".$IDValue ;
			$result = mysql_query($query) or die("Reader Data Query Error");
			if (!$result) 
			{
				$message = 'ERROR:' . mysql_error();
				return $message;
			}
			else
			{
				while ($row = mysql_fetch_array($result)) 
				{
					return $row;
				}
				
			}
			mysql_close();
		}
		catch(Exception $e)
		{
			$e = 'ERROR:'.mysql_error();
			return $e;
		}
		//finally{
		//	mysql_close();
		//}
		
		
	}
		//Function For FileUpload
	function mysql_funX_FileUpload($fileupload,$imgpath)
	{
		try
		{
		  if($_FILES[$fileupload]['error'] > 0)
		  {
			  return ("Error Code : ".$_FILES[$fileupload]['error']);
			  $bool1 = "1";
		  }
		  else
		  {
			  //Declare Save Folder
			 
				  $img = "".$imgpath."/".$_FILES[$fileupload]['name'];
			 
			//if(isset($_SESSION['admin']))
			//{
			  //Save File at Declare Folder
			  move_uploaded_file($_FILES[$fileupload]['tmp_name'],$img);
			//}
			//else
//			{
//				move_uploaded_file($_FILES[$fileupload]['tmp_name'],"../".$img);
//			}
			  //$bool1 = "0";
			  return($img);
		  }
		}
		catch(Exception $e)
		{
			$e = 'ERROR:'.mysql_error();
			return $e;
		}
	}
	//Function For Try Catch
	function mysql_funX_()
	{
		try
		{
		}
		catch(Exception $e)
		{
			
		}
	}
	
	//Functions For GUID
	function funX_GUID(){
    if (function_exists('com_create_guid')){
		$guid=com_create_guid();
		$guid1 = explode("{",$guid);
		$guid1 = explode("}",$guid1[1]);
		return $guid1[0];
//        return com_create_guid();
    }else{
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid =substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12);
        return $uuid;
    }
   }
   
   //Functions for Mail
   function funX_Mail($fromemail,$mail_to,$subject,$message)
   {
		ini_set("SMTP","tls://smtp.gmail.com");
		ini_set('smtp_port',587);
		ini_set('sendmail_from','$fromemail');
		$body_message = 'E-mail: '.$fromemail."\n";
		$body_message .= 'Message: '.$message;
		
		$headers = 'From: '.$fromemail."\r\n";
		$headers .= 'Reply-To: '.$fromemail."\r\n";
		
		$mail_status = mail($mail_to, $subject, $body_message, $headers);
		
		if ($mail_status) {
			return true;
		}
		else {
			return false;
		}
   }
   //CheckInternet Connection
   function funX_CheckInternet()
	{
    $connected = @fsockopen("www.some_domain.com", 80); 
                                        //website, port  (try 80 or 443)
    if ($connected){
        $is_conn = true; //action when connected
        fclose($connected);
    }else{
        $is_conn = false; //action in connection failure
    }
    return $is_conn;

	}
	//Check Hosted on LocalHost
	function funX_WebOn_Localhost() {
    $whitelist = array( '127.0.0.1', '::1' );
		if( in_array( $_SERVER['REMOTE_ADDR'], $whitelist) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	//Remove Query String From Url
	function remove_QueryString_key($url, $key) {
 		return preg_replace('/(?:&|(\?))' . $key . '=[^&]*(?(1)&|)?/i', "$1", $url);
	}

}

?>