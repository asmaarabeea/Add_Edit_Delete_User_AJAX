<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>users, Ajax</title>
	
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
	<script  type="text/css" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css"></script>

	<link rel="stylesheet" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('fontawesome/css/font-awesome.min.css')}}">
	<style>
		.mt-40{
			margin-top: 40px;
		}
		.tr{
			margin-left: 40px;
		}
	
	</style>
</head>
<body>
	<div class="container mt-40">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-6">
					<button class="btn btn-primary btn-block" data-toggle="modal" data-target="#add-new-user-modal" >
						<i class="fa fa-plus"></i> Add New User
					</button>
				</div>
				<div class="col-md-6">
					{{-- <button class="btn btn-block btn-info">
						<i class="fa fa-search"></i>
					</button> --}}
					<form action="#" type="POST" id="search" >
						<div class="form-group">
							{{csrf_field()}}
							<input type="search" name="search" placeholder="Search" class="form-control">
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-12 mt-40">
				<table class="table table-hover table-striped">
					<thead>
						<tr>
							<th class="text-center">ID</th>
							<th class="text-center">Name</th>
							<th class="text-center">Email</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody id="users-output">
					{{-- 	@foreach($users as $user)
							<tr>
								<td>{{$user->id}}</td>
								<td>{{$user->name}}</td>
								<td>{{$user->email}}</td>
							</tr>
						@endforeach --}}
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- ====================================
	=            Add New User            =
	==================================== -->
	<div class="col-sm-6 col-sm-offset-5">

		<div id="add-new-user-modal" class="modal fade " tabindex="-1">
			<div class="modal-dialog modal-lg" >
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title text-center">Add New User</h3>
					</div>
					<div class="modal-body">
						<form action="#" id="add-new-user-form" method="POST">
							{{csrf_field()}}
							<div class="form-group">
								<label for="name">User Name</label>
								<input type="text" name="name" id="name" autocomplete="false" placeholder="User Name ex:john,....." class="form-control">
							</div>
							<div class="form-group">
								<label for="email">E-mail</label>
								<input type="email" name="email" id="email" autocomplete="false" placeholder="E-mail Address ex:email@domain.com" class="form-control">
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" name="password" id="password" autocomplete="new-password" placeholder="Your Password" class="form-control">
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-primary" id="ok" >Save Changes</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							</div>
						</form>
					</div>
					
				</div>
			</div>
		</div><p></p>

	</div>
	<!--  End of Add New User  ====== -->




	<!-- ====================================
	=            Edit User            =
	==================================== -->
	<div class="col-sm-6 col-sm-offset-5">

		<div id="edit-new-user-modal" class="modal fade " tabindex="-1">
			<div class="modal-dialog modal-lg" >
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title text-center">Add New User</h3>
					</div>
					<div class="modal-body">
						<form action="#" id="edit-new-user-form" method="POST">
							{{csrf_field()}}
							{{method_field('PUT')}}
							<input type="hidden" name="id">

							<div class="form-group">
								<label for="name">User Name</label>
								<input type="text" name="name" id="name" autocomplete="false" placeholder="User Name ex:john,....." class="form-control">
							</div>
							<div class="form-group">
								<label for="email">E-mail</label>
								<input type="email" name="email" id="email" autocomplete="false" placeholder="E-mail Address ex:email@domain.com" class="form-control">
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" name="password" id="password" autocomplete="new-password" placeholder="Your Password" class="form-control">
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-primary" id="ok" >Save Changes</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							</div>
						</form>
					</div>
					
				</div>
			</div>
		</div><p></p>

	</div>
	<!--  End of Edit User  ====== -->

	

	<script src="{{asset('plugins/jquery/jquery-3.1.1.js')}}"></script>
	<script src="{{asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>

	<script>


		$(document).ready(function(){


			var getUsers = function(){
				$.ajax({
					url: 'getAllUsers',
					type: 'GET',
					success: function(response){
						var users_output = '';

						// console.log(response);
						$.each(response.users , function(index,value){
							// $("#users-output").append('<tr><td>'+value.id+'</td><td>'+value.name+'</td><td>'+value.email+'</td></tr>');
							users_output += '<tr><td class="text-center view-user" data-id="'+value.id+'" > <i class="fa fa-user"></i> '+value.id+'</td><td class="text-center">'+value.name+'</td><td class="text-center">'+value.email+'</td><td class="text-center text-danger"><i class="fa fa-trash remove-user" data-id=" '+value.id+' " ></i></td></tr>';
						});
						// console.log(users_output);
						$("#users-output").html(users_output);
					}
				});
			};

			getUsers();





			$("form#add-new-user-form").on("submit",function(event){
				event.preventDefault();
				$.ajax({
					url: '',
					type: 'POST',
					data: $(this).serialize(),
					success: function(response){
						// console.log(response.user);
						// $("#users-output").append('<tr><td>'+response.user.id+'</td><td>'+response.user.name+'</td><td>'+response.user.email+'</td></tr>');
						getUsers();
						$("#add-new-user-modal").modal('hide');

					},
					error: function(response){

					},
					beforeSend: function(){

					}
				});
			});





			$("#users-output").on('click','.view-user',function(){
				var id = $(this).data('id');
				$.ajax({
					url: 'getUserInfo',
					data: {id: id},
					type: 'GET',
					success: function(response){
						console.log(response);
						$("#edit-new-user-form input[name=id]").val(response.id);
						$('#edit-new-user-form input[name=name]').val(response.name);
						$('#edit-new-user-form input[name=email]').val(response.email);

						$("#edit-new-user-modal").modal('show');
					}
				});
			});





			$('form#edit-new-user-form').on('submit',function(event){
				event.preventDefault();
				$.ajax({
					url: 'editUserInfo',
					data: $(this).serialize(),
					type: 'POST',
					success: function(response){
						// console.log(response);
						getUsers();
						$("#edit-new-user-modal").modal('hide');
					}
				});
			});





			$("#users-output").on("click",".remove-user",function(event){
				event.preventDefault();
				var id = $(this).data('id');

				swal({
					title: "Are you sure?",
					text: "You will not be able to recover this User!",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Yes, delete it!",
					closeOnConfirm: false
				},
				function(){
					$.ajax({
						url: "deleteUser",
						data: {id: id , _token: '{{ csrf_token() }}' },
						type: "DELETE",
						success: function(response){
						// console.log(response);
						}
					});
					swal("Deleted!", "Your user file has been deleted.", "success");
					getUsers();

				});

			});






			$("form#search").on("keyup",function(event){
				event.preventDefault();
				// console.log("Done");
				$.ajax({
					url: 'search',
					data: $(this).serialize(),
					method: "POST",
					success: function(response){
						var users_output = '' ;
						// console.log("response");
						$.each(response,function(index,value){
							users_output += '<tr><td class="text-center view-user" data-id="'+value.id+'" > <i class="fa fa-user"></i> '+value.id+'</td><td class="text-center">'+value.name+'</td><td class="text-center">'+value.email+'</td><td class="text-center text-danger"><i class="fa fa-trash remove-user" data-id=" '+value.id+' " ></i></td></tr>';					
						});
						
						$("#users-output").html(users_output);
					}
				});
			});


		});


		/*$(function(){

		});*/

	</script>

</body>
</html>