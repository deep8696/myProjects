
    <div class="content-box">
		<div class="site-title clear">
			<h1 class="hside pull-left">MedicineSub Types</h1>
           
           <a href="admin.php?page=pages/medicinesubtypesList.php" class="addbtn pull-right"><i class="fa fa-angle-left"></i> Back</a>
        </div>

	
     <div class="panel panel-admin">
        <div class="panel-header">
            Add Medicine Sub Type
        </div>
        <div class="panel-body">
            <div class="form-vertical">
            <div class="form-group">
                    <label>Medicine Type</label>
                    <select name="medicinesubtype" id="medicinesubtype" class="form-drop-control">
      					<option value="msubtype1">Type 1</option>
      					<option value="msubtype2">Type 2</option>
      				</select>
                    
                </div>
                <div class="form-group">
                    <label>Medicine SubType</label><input type="text" name="txtMedicinesubtype" id="txtMedicinesubtype" class="form-drop-control"/>
                    
                </div>
            </div>
        </div>
        <div class="panel-footer text-center">
            <button id="btnSave" class="btn btn-theme" name="btnSave" type="submit"><i class="fa fa-save"></i>Save</button>
            <a href="admin.php?page=pages/medicinesubtypesList.php" class="btn btn-link">Cancel</a>
        </div>
    </div>
    </div>