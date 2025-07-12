@extends('layouts.dashboard')

@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Payroll</h3>
                    <p class="text-subtitle text-muted">Handle Payroll data</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Payroll</li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        Edit
                    </h5>
                </div>
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('payrolls.update', $payroll->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-2">
                            <label for="" class="form-label">Employee</label>
                            <select name="employee_id" id="employee_id" class="form-control">
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}"
                                        {{ $payroll->employee_id == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->fullname }}</option>
                                @endforeach
                            </select>
                            @error('employee_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="" class="form-label">Salary</label>
                            <input type="number" class="form-control" name="salary" required
                                value="{{ old('salary', $payroll->salary) }}">
                            @error('salary')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="" class="form-label">Deductions</label>
                            <input type="number" class="form-control" name="deductions" required
                                value="{{ old('deductions', $payroll->deductions) }}">
                            @error('deductions')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="" class="form-label">Bonuses</label>
                            <input type="number" class="form-control" name="bonuses" required
                                value="{{ old('bonuses', $payroll->bonuses) }}">
                            @error('bonuses')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        {{-- <div class="mb-2">
                            <label for="" class="form-label">Net Salary</label>
                            <input type="number" class="form-control" name="net_salary" disabled>
                            @error('net_salary')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> --}}

                        <div class="mb-2">
                            <label for="" class="form-label">Pay Date</label>
                            <input type="text" class="form-control date" name="pay_date" required
                                value="{{ old('pay_date', $payroll->pay_date) }}">
                            @error('pay_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('payrolls.index') }}" class="btn btn-secondary">Back to List</a>
                    </form>
                </div>
            </div>

        </section>
    </div>
@endsection
