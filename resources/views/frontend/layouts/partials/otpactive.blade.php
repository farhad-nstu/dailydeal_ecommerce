<div class="row justify-content-center">
                           <div class="alert alert-warning" role="alert">
                              We have send activation code to your phone please input it below.
                            </div>
                </div>
                <div class="row justify-content-center">
                            <form action="{{route('otp.active')}}" method="post">
                              @csrf
                              <div class="form-group">
                                <label for="otp">Activation Code</label>
                                <input type="text" class="form-control" id="otp" name="otp">
                              </div>
                              
                              <button type="submit" class="btn btn-primary">Active Account</button>
                            </form>
                </div>