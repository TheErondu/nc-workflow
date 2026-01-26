@extends('layouts.app', ['activePage' => 'manual-reports', 'titlePage' => __('Create Manual Report')])
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card-opaque">
                <div class="card-header" style="background-color: #272727;">
                    <h5 class="card-title" style="color: white;">Add Manual Report</h5>
                </div>
                <div class="row">
                    @if (Session::has('message'))
                        <div class="container">
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <div class="alert-icon">
                                    <i class="far fa-fw fa-bell"></i>
                                </div>
                                <div class="alert-message">
                                    <strong>{{ session('message') }}</strong>
                                </div>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="container">
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                @foreach ($errors->all() as $error)
                                    <div class="alert-icon">
                                        <i class="far fa-fw fa-bell"></i>
                                    </div>
                                    <div class="alert-message">
                                        <strong>{{ $error }}</strong>
                                    </div>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <!-- Template Download & Import Section -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card h-100" style="background-color: #1a1a1a; border: 1px solid #333;">
                                <div class="card-body">
                                    <h6 class="card-title" style="color: #fff;"><i class="fas fa-download me-2"></i>Download Template</h6>
                                    <p class="text-muted small">Download a pre-formatted Word template to fill out offline.</p>
                                    <div class="row align-items-end">
                                        <div class="col-md-6 mb-2">
                                            <label for="template_type">Template Type</label>
                                            <select id="template_type" class="form-control">
                                                @foreach ($reportTypes as $key => $label)
                                                    <option value="{{ $key }}">{{ $label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <a href="{{ route('manual-reports.template', ['type' => 'director']) }}"
                                               id="downloadTemplateBtn"
                                               class="btn btn-outline-light btn-sm">
                                                <i class="fas fa-file-word me-1"></i> Download .docx
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100" style="background-color: #1a1a1a; border: 1px solid #333;">
                                <div class="card-body">
                                    <h6 class="card-title" style="color: #fff;"><i class="fas fa-upload me-2"></i>Import from Word</h6>
                                    <p class="text-muted small">Upload a filled Word document to auto-populate the content field.</p>
                                    <div class="row align-items-end">
                                        <div class="col-md-8 mb-2">
                                            <input type="file" id="word_file" class="form-control form-control-sm" accept=".docx">
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <button type="button" id="importBtn" class="btn btn-outline-success btn-sm" disabled>
                                                <i class="fas fa-file-import me-1"></i> Import
                                            </button>
                                        </div>
                                    </div>
                                    <div id="importStatus" class="small mt-2" style="display: none;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('manual-reports.store') }}">
                        @csrf

                        <div class="row justify-content-between">
                            <div class="mb-3 col-md-6">
                                <label for="title">Report Title <span class="text-danger">*</span></label>
                                <input name="title" type="text" class="form-control" id="title"
                                       value="{{ old('title') }}" required placeholder="Enter report title">
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="report_type">Report Type <span class="text-danger">*</span></label>
                                <select name="report_type" id="report_type" class="form-control" required>
                                    <option value="">Select Type</option>
                                    @foreach ($reportTypes as $key => $label)
                                        <option value="{{ $key }}" {{ old('report_type') == $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="report_date">Report Date <span class="text-danger">*</span></label>
                                <input name="report_date" type="date" class="form-control" id="report_date"
                                       value="{{ old('report_date', date('Y-m-d')) }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-12">
                                <label for="content">Report Content <span class="text-danger">*</span></label>
                                <textarea name="content" id="content" class="form-control" rows="20"
                                          required placeholder="Enter your report content here, paste from clipboard, or import from a Word document.">{{ old('content') }}</textarea>
                                <small class="text-muted">You can type directly, paste content, or use the Import feature above to load from a Word document.</small>
                            </div>
                        </div>

                        <div class="row justify-content-between">
                            <div class="mb-3 col-md-6">
                                <a href="{{ route('manual-reports.index') }}" style="background-color: rgb(53, 54, 55) !important;"
                                   class="btn btn-primary">Cancel</a>
                            </div>
                            <div class="mb-3 col-md-1">
                                <button style="background-color: rgb(37, 38, 38) !important;" type="submit"
                                        class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var templateSelect = document.getElementById('template_type');
        var downloadBtn = document.getElementById('downloadTemplateBtn');
        var reportTypeSelect = document.getElementById('report_type');
        var baseUrl = "{{ route('manual-reports.template') }}";
        var wordFileInput = document.getElementById('word_file');
        var importBtn = document.getElementById('importBtn');
        var importStatus = document.getElementById('importStatus');
        var contentTextarea = document.getElementById('content');

        // Update download link when template type changes
        templateSelect.addEventListener('change', function() {
            downloadBtn.href = baseUrl + '?type=' + this.value;
        });

        // Sync template type with report type when report type changes
        reportTypeSelect.addEventListener('change', function() {
            if (this.value) {
                templateSelect.value = this.value;
                downloadBtn.href = baseUrl + '?type=' + this.value;
            }
        });

        // Enable/disable import button based on file selection
        wordFileInput.addEventListener('change', function() {
            importBtn.disabled = !this.files.length;
            importStatus.style.display = 'none';
        });

        // Handle import
        importBtn.addEventListener('click', function() {
            if (!wordFileInput.files.length) return;

            var formData = new FormData();
            formData.append('word_file', wordFileInput.files[0]);
            formData.append('_token', '{{ csrf_token() }}');

            importBtn.disabled = true;
            importBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Importing...';
            importStatus.style.display = 'block';
            importStatus.className = 'small mt-2 text-info';
            importStatus.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Processing document...';

            fetch('{{ route("manual-reports.import") }}', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    contentTextarea.value = data.content;
                    importStatus.className = 'small mt-2 text-success';
                    importStatus.innerHTML = '<i class="fas fa-check me-1"></i> Document imported successfully!';
                } else {
                    importStatus.className = 'small mt-2 text-danger';
                    importStatus.innerHTML = '<i class="fas fa-exclamation-circle me-1"></i> ' + (data.message || 'Import failed');
                }
            })
            .catch(error => {
                importStatus.className = 'small mt-2 text-danger';
                importStatus.innerHTML = '<i class="fas fa-exclamation-circle me-1"></i> Error importing document';
                console.error('Import error:', error);
            })
            .finally(() => {
                importBtn.disabled = false;
                importBtn.innerHTML = '<i class="fas fa-file-import me-1"></i> Import';
            });
        });
    });
</script>
@endsection
