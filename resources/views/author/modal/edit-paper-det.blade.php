<!-- Form for add new hall -->
<form action="{{ url('/conf/'.$conf->Conference_abbr.'/mypaper/upd-paper-details/')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <!-- Modal container -->
    <div class="modal fade text-left" id="updatePaperDet" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <!-- Modal border properties -->
            <div class="modal-content rounded">
                <!-- Modal header properties -->
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <!-- Modal title -->
                    <h5 class="modal-title fw-bold mb-0">Update My Paper Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body p-5 pt-0">
                    <!--Conference's Name -->
                    <div class="form-floating mb-3">
                        <label for="floatingInput"><b>{{$conf->Conference_name }} ({{$conf->Conference_abbr }})</b></label>
                        <input type="text" name="cname" id="cname" class="form-control" disabled>
                    </div>
                    <!--Conference's ID -->
                    <div class="form-floating mb-3">
                        <label for="floatingInput"><b>Paper ID ({{ $paper->Paper_id }})</b></label>
                        <input type="text" name="pid" id="pid" class="form-control" disabled>
                    </div>
                    <!-- Paper Title -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="paperTitle" name="title" value="{{$paper->paper_title}}" placeholder="Title" required>
                        <label for="floatingInput">Paper Title</label>
                    </div>
                    <!-- Abstract -->
                    <div class="form-floating mb-3">
                        <textarea type="double" rows="2" name="abstract" id="abstract" class="form-control" placeholder="Abstract" required>{{$paper->abstract}}</textarea>
                        <label for="floatingInput">Paper Abstract (between 200 and 250 words)</label>
                        <small id="abstract-word-count" class="form-text text-muted"></small>
                    </div>
                    <!-- Submit button -->
                    <button type="submit" id="upd-paper-det-subBtn" class="w-100 mb-2 btn rounded-4 btn-primary" disabled>Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    const abstractTextarea = document.getElementById('abstract');
    const wordCountElement = document.getElementById('abstract-word-count');
    const submitButton = document.getElementById('upd-paper-det-subBtn');

    abstractTextarea.addEventListener('input', function() {
        const abstract = abstractTextarea.value;
        const wordCount = abstract.trim().split(/\s+/).length;

        if (wordCount < 200 || wordCount > 250) {
            wordCountElement.textContent = 'Word count must be between 200 and 250 words.';
            submitButton.disabled = true;
        } else {
            wordCountElement.textContent = `Word count: ${wordCount}`;
            submitButton.disabled = false;
        }
    });
</script>