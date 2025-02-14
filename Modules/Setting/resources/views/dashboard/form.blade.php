<div class="row g-3">
    <div class="col-sm-6">
        <x-dashboard.forms.input type="text" label="slug" name="slug"
            value="{{ request('slug', $setting->slug ?? '') }}" placeholder="Enter slug" required="true" />
    </div>
    <div class="col-sm-6">
        <x-dashboard.forms.select id="typeSelect" label="Name" name="name" placeholder="Enter name" required="true">
            <option value="text">Text</option>
            <option value="file">file</option>
        </x-dashboard.forms.select>
    </div>
    <div class="col-sm-6">
        <x-dashboard.forms.input type="email" label="email" name="email" placeholder="Enter email" required="true"
            hint="Email is unique" value="{{ request('email', $setting->email ?? '') }}" />
    </div>
</div>

<div id="type-value" class="col-sm-6">
</div>


<div id="" class="mb-3">
    <label class="form-label" for="basic-default-message">Message</label>
    <textarea id="basic-default-message" class="form-control" placeholder="Hi, Do you have a moment to talk Joe?"></textarea>
</div>


@push('scripts')
    <script>
        $('#typeSelect').on('change', function() {
            var selectedValue = $(this).val(); // Get selected value using jQuery

            alert(this.value);
        });
    </script>
@endpush
