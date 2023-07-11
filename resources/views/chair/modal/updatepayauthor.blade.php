@foreach($listauthor as $listaut)    
    <form action="{{ url('/conf/'.$conf->Conference_abbr.'/payment/update-payment/')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <!-- Modal container -->
        <div class="modal fade" id="updPayModalA{{ $listaut->Author_id }}" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="updPayModalA{{ $listaut->Author_id }}Label">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <!-- Modal border properties -->
                <div class="modal-content rounded">
                    <!-- Modal header properties -->
                    <div class="modal-header p-5 pb-4 border-bottom-0">
                        <!-- Modal title -->
                        <h5 class="text-2xl modal-title fw-bold mb-0">Participant Payment Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body p-5 pt-0">
                        <!--Payment's ID -->
                        <div class="my-2">
                            <label for="pid"><b>Payment ID</b>
                                <input type="text" name="pid" id="pid" value="{{$listaut->payment->Payment_id}}" class="form-control mb-3" disabled>
                                <input type="hidden" name="pid" id="pid" value="{{$listaut->payment->Payment_id}}" class="form-control mb-3">
                            </label>
                            
                        </div>
                        <!--Payment's Type -->
                        <div class="my-2">
                            <label for="floatingInput"><b>Payment's Type</b></label>
                            <input type="text" name="feeType" id="feeType"  value="{{$listaut->payment->fee->Type}}" class="form-control mb-3" disabled>
                        </div>
                        <!--Payment's Detail -->
                        <div class="my-2">
                            <label for="floatingInput"><b>Payment's Detail</b></label>
                            <input type="text" name="feeDet" name="feeDet"  value="{{$listaut->payment->fee->Fee_details}}" class="form-control mb-3" disabled>
                        </div>
                        <!--Proof of Payment-->
                        <div class="my-2 text-center text-primary">
                            <a href="{{ asset('upload/proofpayment/'.$listaut->payment->file) }}" target="_blank">View Uploaded Proof of Payment</a>
                        </div>
                        <!--Update Payment Status-->
                        <div class="col-md-4 ">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select mb-3" required>
                                <option value="Unpaid" {{ $listaut->payment->payment_status == 'Unpaid' ? 'selected' : '' }}>Unpaid</option>
                                <option value="Pending" {{ $listaut->payment->payment_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Paid" {{ $listaut->payment->payment_status == 'Paid' ? 'selected' : '' }}>Paid</option>
                            </select>
                        </div>
                        
                        <!-- Submit button -->
                        <button id="updPaysubmitBtn" type="submit" class="w-100 mb-2 btn rounded-4 btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endforeach
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('form').on('submit', function(e) {
            // Show confirmation dialog
            if (!confirm("Are you sure you want to update this participant's payment status?")) {
                e.preventDefault(); // Prevent form submission if user cancels
            }
        });
    });
</script>