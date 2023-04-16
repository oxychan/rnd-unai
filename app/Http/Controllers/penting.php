<form method="POST" action="{{ route('form.submit') }}">
    @csrf
    <table id="myTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="text" name="name[]" class="form-control"></td>
                <td><input type="email" name="email[]" class="form-control"></td>
                <td><input type="tel" name="phone[]" class="form-control"></td>
            </tr>
        </tbody>
    </table>
    <button type="button" id="addRow" class="btn btn-primary">Add Row</button>
    <button type="submit" class="btn btn-success">Submit</button>
</form>

<script>
    $(document).ready(function() {
        // Add new row when button is clicked
        $('#addRow').click(function() {
            var newRow = '<tr>' +
                '<td><input type="text" name="name[]" class="form-control"></td>' +
                '<td><input type="email" name="email[]" class="form-control"></td>' +
                '<td><input type="tel" name="phone[]" class="form-control"></td>' +
                '</tr>';
            $('#myTable tbody').append(newRow);
        });
    });
</script>

<!-- php artisan make:request MyFormRequest -->

<?php

// namespace App\Http\Requests;

// use Illuminate\Foundation\Http\FormRequest;

// class MyFormRequest extends FormRequest
// {
//     public function rules()
//     {
//         $rules = [];

//         foreach ($this->request->get('name') as $key => $value) {
//             $rules["name.{$key}"] = 'required|string|max:255';
//             $rules["email.{$key}"] = 'required|email|max:255';
//             $rules["phone.{$key}"] = 'required|string|max:20';
//         }

//         return $rules;
//     }
// }

// public function submit(MyFormRequest $request)
// {
//     $validatedData = $request->validated();

//     foreach ($validatedData['name'] as $key => $value) {
//         $data = new MyModel;
//         $data->name = $validatedData['name'][$key];
//         $data->email = $validatedData['email'][$key];
//         $data->phone = $validatedData['phone'][$key];
//         $data->save();
//     }

//     return redirect()->back()->with('success', 'Form submitted successfully!');
// }
