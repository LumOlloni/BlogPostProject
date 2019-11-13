@extends('frontend.layouts.app')

@section('content')
{{-- <div id="app"> --}}
<div id="frendStyle">
    <div class="container mr-4">
        <h2 class="text-center">Welcome {{Auth::user()->name}}  </h2>
        <h4 class="text-center text-primary"> Friends Request </h4>
        {{-- <div id="app"> --}}
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                 <tr v-for="user in user_frends">
                    <td> @{{ user.name }} </td>
                    <td> @{{ user.email}} </td>
                    <td>Button</td>
                </tr>
            </tbody>
          </table>
        {{-- </div> --}}


        <h4 class="text-center text-primary"> Add Frends </h4>
        <div class="row ">
            <div class="col-md-8">
            {{-- <div id="app"> --}}
                <div v-for="friends in usersNotFriend" class="people-nearby">
                
                    {{-- @foreach ($not_friends as $item) --}}
                        <div class="nearby-user">
                            <div class="row">
                            <div class="col-md-2 col-sm-2">
                                {{-- <p> @{{ friends.image }} src="/images/profileUser/@{{friends.image }}" </p> --}}
                                <img :src="'/images/profileUser/'+friends.image   "alt="user" class="profile-photo-lg">
                            </div>
                            <div class="col-md-7 col-sm-7">
                                <h5><a href="#" class="profile-link"> @{{ friends.name }} </a></h5>
                                <p> @{{ friends.email }}</p>
                                <p class="text-muted">Member since: @{{  friends.createdAt }} </p>
                            </div>
                                <div class="col-md-3 col-sm-3">
                                    <button  v-on:click="sendFriendRequest(friends.id)" type="submit" class="btn btn-primary pull-right">Add Friend</button>
                                </div>
                            </div>
                        </div>
                {{-- @endforeach --}}
                </div>
            {{-- </div> --}}
            </div>
        </div>
    </div>
    </div>
{{-- </div> --}}
    {{-- @jquery
    @toastr_js
    @toastr_render --}}
@endsection


@section('scripts')

    <script>       
        const app = new Vue({
            el: "#app",
            data:{
                usersNotFriend:{},
                user_frends:{},
                user: {!! Auth::user()->toJson() !!}
            },
            mounted(){
                this.allUser();
                this.friendOfUsers();
            },
            methods:{
                sendFriendRequest(id){
                    axios.post('friendRequest', {
                        id:id 
                    })
                    .then((response) => { 
                        console.log(response.data)
                        this.allUser();
                        })
                    .catch(err => console.log(err))
                },
                allUser(){
                    axios('getNotFriends')
                    .then((response) => {
                        this.usersNotFriend = response.data;
                        // console.log("Qendrim Hasi");
                    })
                   .catch(err => console.log(err));
                },
                friendOfUsers(){
                    axios(`getFriends/${this.user.id}`)
                    .then((response) => {
                        this.user_frends = response.data[0].friends;
                        console.log(this.user_frends);
                    } 
                   )
                    .catch(err => console.log(err));

                }
            }
        });

    </script>
@endsection
