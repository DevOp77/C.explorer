
  $(document).ready(function(){
  	  $(document).on('change','#file',function(){

          var property = document.getElementById("file").files[0];
          var image_name = property.name;

          //alert("Image name: " + image_name);
          var image_extension = image_name.split('.').pop().toLowerCase();
          

          if (jQuery.inArray(image_extension,['gif','png','jpg','jpeg'])==-1)
          {
          		 alert("The selected image file is invalid");
          }
          else
          {
          				
          		
						//-----------------   uploading image  ----------------------------------
     					var image_size = property.size;
              
              //alert("Image Size: " + image_size);
     					
     					if (image_size>200000)
     					{
     						 alert("The selected image file size is larger than required.");

     					}
     					else
     					{
     								var form_data = new FormData();
     							
		     						form_data.append("file",property);
		     						$.ajax({
		     							url:"server/uploadavatar.php",
		     							method:"POST",
		     							data:form_data,
		     							contentType: false,
		     							cache:false,
		     							processData:false,
		     							beforeSend:function(){
		     								$('#uploaded_image').html("<label class='text-success'>Uploading...</label>")
		     							},
		     							success:function(data)
		     							{
		     								//alert(data);
		     								$("#userphoto").attr('src',"tabernacle2/"+data);
		     							}
		     						});
     					}
     					//------------------ end of uploading image ------------------------

          }//end of if statement for image extension

  	  });//end of document change for file








  })

