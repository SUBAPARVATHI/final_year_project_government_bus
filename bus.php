<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Issue</title>
    <style>
        /* Background Styling */
        body {
            background: linear-gradient(135deg,rgb(191, 193, 204), #764ba2); /* Pink Gradient */
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Form Container */
        .container {
            width: 400px;
            background: rgba(255, 255, 255, 0.3); /* Glassmorphism Effect */
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px); /* Blurry Background */
            text-align: center;
        }

        h2 {
            color: white;
            margin-bottom: 20px;
        }

        /* Input Fields */
        input, textarea {
            width: 100%;
            margin: 10px 0;
            padding: 12px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.8);
        }

        /* Submit Button */
        button {
            background-color: #28a745;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #218838;
        }
    </style>
</head>
 <section id="" class="d-flex align-items-center">
<main id="main">
	<div class="container-fluid">
		<div class="col-lg-12">
			<div class="row">
				<div class="col-md-12">
					<button class="float-right btn btn-success btn-md" type="button" id="new_bus">Add New <i class="fa fa-plus"></i></button>
				</div>
			</div>
			<div class="row">
				&nbsp;
			</div>
			<div class="row">
				<div class="card col-md-12">
				<div class="card-header">
						<div class="card-title"><b>Bus List</b></div>
					</div>
					
					<div class="card-body">
						<table class="table table-hover table-striped" id="bus-field">
						<thead class='thead-light'>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Bus No.</th>
									<th class="text-center">Bus Name</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</main>
</section>
<script>
	$('#new_bus').click(function(){
		uni_modal('Add New Bus','manage_bus.php')
	})
	window.load_bus = function(){
		$('#bus-field').dataTable().fnDestroy();
		$('#bus-field tbody').html('<tr><td colspan="4" class="text-center">Please wait...</td></tr>')
		$.ajax({
			url:'load_bus.php',
			error:err=>{
				console.log(err)
				alert_toast('An error occured.','danger');
			},
			success:function(resp){
				if(resp){
					if(typeof(resp) != undefined){
						resp = JSON.parse(resp)
							if(Object.keys(resp).length > 0){
								$('#bus-field tbody').html('')
								var i = 1 ;
								Object.keys(resp).map(k=>{
									var tr = $('<tr></tr>');
									tr.append('<td class="text-center">'+(i++)+'</td>')
									tr.append('<td class="text-center">'+resp[k].bus_number+'</td>')
									tr.append('<td>'+resp[k].name+'</td>')
									tr.append('<td><center><button class="btn btn-sm btn-info edit_bus mr-2" data-id="'+resp[k].id+'">Edit</button><button class="btn btn-sm btn-danger remove_bus" data-id="'+resp[k].id+'">Delete</button></center></td>')
									$('#bus-field tbody').append(tr)

								})

							}else{
								$('#bus-field tbody').html('<tr><td colspan="4" class="text-center"><b>THEREs NO DATA HERE!!</b>.</td></tr>')
							}
					}
				}
			},
			complete:function(){
				$('#bus-field').dataTable()
				manage();
			}
		})
	}
	function manage(){
		$('.edit_bus').click(function(){
		uni_modal('Edit New Bus','manage_bus.php?id='+$(this).attr('data-id'))

		})
		$('.remove_bus').click(function(){
		_conf('Are you sure to delete this data?','remove_bus',[$(this).attr('data-id')])

		})
	}
	function remove_bus($id=''){
		start_load()
		$.ajax({
			url:'delete_bus.php',
			method:'POST',
			data:{id:$id},
			error:err=>{
				console.log(err)
				alert_toast("An error occured","danger");
				end_load()
			},
			success:function(resp){
				if(resp== 1){
					alert_toast("Data succesfully deleted","success");
					end_load()
					$('.modal').modal('hide')
					load_bus()
				}
			}
		})
	}
	$(document).ready(function(){
		load_bus()
	})
</script>