<!-- Form for add new hall -->
<form action="{{ url('/conf/'.$conf->Conference_abbr.'/committeemenu/add-fees/')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <!-- Modal container -->
    <div class="modal fade text-left" id="addFeeModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <!-- Modal border properties -->
            <div class="modal-content rounded">
                <!-- Modal header properties -->
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <!-- Modal title -->
                    <h5 class="modal-title fw-bold mb-0">Add Fee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body p-5 pt-0">
                    <!--Conference's ID -->
                    <div class="form-floating mb-3">
                        <label for="floatingInput"><b>Conference ID ({{ $conf->Conference_id }})</b></label>
                        <input type="text" name="cid" class="form-control" disabled>
                    </div>
                    <!--Conference's Name -->
                    <div class="form-floating mb-3">
                        <label for="floatingInput"><b>{{$conf->Conference_name }} ({{$conf->Conference_abbr }})</b></label>
                        <input type="text" name="cname" class="form-control" disabled>
                    </div>
                    <!-- Fee Type -->
                    <div class="col-md-4 ">
                        <label for="floatingInput" class="form-label">Participant Type</label>
                        <select name="type" id="type" class="form-select mb-3" required>
                            <option value="" disabled selected>Select an option</option>
                            <option value="Author">Author</option>
                            <option value="Listener/Delegate">Listener/Delegate</option>
                        </select>
                    </div>
                    <!-- Fee Details -->
                    <div class="form-floating mb-3">
                        <input type="text" name="details" class="form-control" placeholder="Fee Details" required>
                            <label for="floatingInput">Fee Details</label>
                    </div>
                    <!-- Amount -->
                    <div class="form-floating mb-3">
                        <input type="number" name="amount" class="form-control" step="0.01" placeholder="Amount" required>
                            <label for="floatingInput">Amount</label>
                    </div>
                    <!-- Submit button -->
                    <button id="addfeesubmitBtn" type="submit" class="w-100 mb-2 btn rounded-4 btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#addfeesubmitBtn').on('click', function (e) {
        var checkbox = $('#default-checkbox');
            e.preventDefault(); // Prevent the default form submission

            // Show confirmation dialog
            if (confirm("\nAre you sure you want to add this fee?\n\nPlease note that you won't be able to modify or delete the added fee after your submission.")) {
                // Proceed with the form submission
                $('form').submit();
            }
    });
</script>