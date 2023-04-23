// A $( document ).ready() block.
$( document ).ready(function() {
	
	// function to view modal
	function showMessageDialog(title, body) {
		document.getElementById('title-modal').innerHTML = ""+title;
		document.getElementById('body-modal').innerHTML = ""+body;
		var mes_diag = new bootstrap.Modal(document.getElementById('message-dialog'))
		mes_diag.show();
	}

		// default
	$('#max-sample-size').val("50");		
			
	// handle button start prediction
	$("#btn-predict").click(function(){
		var txtURL = $("#basic-url").val();
		var txtSampleSize = $("#max-sample-size").val();
	
		
		console.log("Link Youtube: "+txtURL);
		console.log("Sample Size: "+txtSampleSize);
		
		if(txtURL.length === 0) {
			showMessageDialog("Warning Message", "Please, provide the link address.");
		}else if(txtSampleSize.length === 0) {
			showMessageDialog("Warning Message", "Please, provide number of input sample.");
		}else if(!$.isNumeric(txtSampleSize)) {
			showMessageDialog("Warning Message", "Please enter only numbers into number of samples.");
		}else if(parseInt(txtSampleSize, 50)==null || parseInt(txtSampleSize, 50) < 50 || parseInt(txtSampleSize, 50) > 200) {
			showMessageDialog("Warning Message", "Sample size must be between 50 and 200.");
		}else{
			// buat array
			var arr_data = { 
				urlYtb    : ""+txtURL,
				size      : ""+txtSampleSize,
			};
			
			// run progress bar
			var prog_diag = new bootstrap.Modal(document.getElementById('static-progress-bar-dialog'))
			prog_diag.show();
					
					
			// ajax function
			$.ajax({
				url: "./predict_actions.php",
				type: "post",
				data: arr_data,
				success: function (response){
					if(response.includes("success")){
						window.location.href = "report.php";
					}else{
						alert(""+response);
						//alert("Sorry, we found an error. Please try again.");
						location.reload();
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					alert("Sorry, we found an error.");
				   console.log(textStatus, errorThrown);
				   location.reload();
				}
			});
		}
	});


    // handle button 'cancel prediction'
	$('#btn-cancel-predict').click(function() {
		location.reload();
	});

	var diag_prog_bar = document.getElementById('static-progress-bar-dialog');
	diag_prog_bar.addEventListener('hidden.bs.modal', function (event) {
	  location.reload();
	});

});