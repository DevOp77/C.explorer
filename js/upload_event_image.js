$(document).ready(function(){
	$(document).on('change','#file',function(){
		var property = document.getElementById("file").files[0];
		var image_name = property.name;

		var image_extension = image_name.split('.').pop().toLowerCase();
          

          if (jQuery.inArray(image_extension,['gif','png','jpg','jpeg'])==-1)
          {
          		 alert("The selected image file is invalid");
          }
          else
          {
          			//-----------------   uploading image  ----------------------------------
     					var image_size = property.size;              
              
     					
     					if (image_size>5000000)
     					{
     						 alert("The selected image file size is larger than required.");

     					}
     					else
     					{
     								//alert("am uploading now...");

     								$("#previewImage").attr('src',"images/spinner.gif");
     								var form_data = new FormData();
     							
		     						form_data.append("file",property);
		     						
		     						$.ajax({
		     							url:"server/uploadeventimage.php",
		     							method:"POST",
		     							data:form_data,
		     							dataType: 'json',
		     							contentType: false,
		     							cache:false,
		     							processData:false,
		     							beforeSend:function(){
		     								$('#uploaded_image').html("<label class='text-success'>Uploading...</label>")
		     							},
		     							success:function(data)
		     							{
		     								//alert(JSON.stringify(data));
		     								 var status = data.status;
		     								 var location = data.location;
		     								 var name = data.name;

		     								 //alert(location);
		     								 

		     								 if (status==true)
		     								 {
		     								 	$("#previewImage").attr('src',"tabernacle2/"+location);
		     								 }else
		     								 {
		     								 	$("#previewImage").attr('src',"images/fileuploadimg.JPG");
		     								 }
		     								
		     							}
		     						});
     					}
     					//------------------ end of uploading image ------------------------


          }//end of if statement on inArray image extension

		
	})//end of document change function on file

})// end of document ready function
