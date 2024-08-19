<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password as RulesPassword;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
class UserImportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function import(Request $request)
    {
        // Validate the uploaded file
    $request->validate([
        'file' => 'required|file|mimes:xlsx,xls',
    ]);

    $file = $request->file('file');

    // Load the spreadsheet
    $spreadsheet = IOFactory::load($file->path());
    $sheet = $spreadsheet->getActiveSheet();
    $rows = $sheet->toArray();

    // Extract headers from the first row
    $headers = array_shift($rows);

    // Define the required columns
    $requiredColumns = ['Name', 'Email', 'Password', 'User Type', 'Index Number', 'Department', 'Level'];
    $missingColumns = array_diff($requiredColumns, $headers);

    if (!empty($missingColumns)) {
        return redirect()->back()->withErrors(['error' => 'Missing required columns: ' . implode(', ', $missingColumns)]);
    }

    // Validate each row
    foreach ($rows as $row) {
        $data = array_combine($headers, $row);

        // Skip invalid rows where data is not properly matched
        if ($data === false) {
            continue;
        }

        $validator = Validator::make($data, [
            'Name' => 'required|string|max:255',
            'Email' => 'required|email|unique:users,email|max:255',
            'Password' => 'required|string',
            'User Type' => 'required|string|in:admin,staff,student',
            'Index Number' => 'nullable|string|unique:users,index_number',
            'Department' => 'nullable|string|max:255',
            'Level' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Process the valid row (e.g., save to the database)
        User::create([
            'name' => $data['Name'],
            'email' => $data['Email'],
            'password' => Hash::make($data['Password']),  
            'usertype' => $data['User Type'],
            'index_number' => $data['Index Number'],
            'department' => $data['Department'],
            'level' => $data['Level'],
        ]);
    }

    return redirect()->back()->with('success', 'File imported successfully.');
}
   

// public function downloadTemplate()
// {
//     // Create a new Spreadsheet object
//     $spreadsheet = new Spreadsheet();

//     // Set the active sheet
//     $sheet = $spreadsheet->getActiveSheet();

//     // Set the header values
//     $sheet->setCellValue('A1', 'Name');
//     $sheet->setCellValue('B1', 'Email');
//     $sheet->setCellValue('C1', 'Password');
//     $sheet->setCellValue('D1', 'User Type');
//     $sheet->setCellValue('E1', 'Index Number');
//     $sheet->setCellValue('F1', 'Department');
//     $sheet->setCellValue('G1', 'Level');

//     // Optionally, you can add some example data or instructions in the first row
//     $sheet->setCellValue('A2', 'John Doe');
//     $sheet->setCellValue('B2', 'johndoe@example.com');
//     $sheet->setCellValue('C2', 'securepassword');
//     $sheet->setCellValue('D2', 'admin, staff, student');
//     $sheet->setCellValue('E2', '123456');
//     $sheet->setCellValue('F2', 'IT Department');
//     $sheet->setCellValue('G2', '100');

//     // Create a writer to generate the file
//     $writer = new Xlsx($spreadsheet);

//     // Stream the file to the browser
//     return response()->stream(
//         function() use ($writer) {
//             $writer->save('php://output');
//         },
//         200,
//         [
//             'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
//             'Content-Disposition' => 'attachment; filename="UserTemplate.xlsx"',
//             'Cache-Control' => 'max-age=0',
//         ]
//     );
// }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
