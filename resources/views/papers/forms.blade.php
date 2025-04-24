<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="form-group">
                        <label for="title">Title *</label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title', $paper->title ?? '') }}" required>
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Authors *</label>

                        <div class="mb-2">
                            <label>Existing Authors</label>
                            <select name="existing_authors[]" class="form-control select2-multiple" multiple="multiple">
                                @foreach($allAuthors as $author)
                                    <option value="{{ $author->id }}"
                                        {{ (isset($paper) && $paper->authors->contains($author->id)) ? 'selected' : '' }}>
                                        {{ $author->lastname }}, {{ $author->firstname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-2">
                            <label>Add New Authors (separate with semicolons ; )</label>
                            <textarea name="new_authors" class="form-control" rows="2"
                                      placeholder="e.g., Smith, John; Doe, Jane">{{ old('new_authors') }}</textarea>
                            <small class="form-text text-muted">Format: Lastname, Firstname</small>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="date_of_issue">Date of Issue</label>
                            <input type="date" name="date_of_issue" id="date_of_issue"
                                   class="form-control @error('date_of_issue') is-invalid @enderror"
                                   value="{{ old('date_of_issue', isset($paper->date_of_issue) ? $paper->date_of_issue->format('Y-m-d') : '') }}">
                            @error('date_of_issue')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="publisher">Publisher</label>
                            <input type="text" name="publisher" id="publisher"
                                   class="form-control @error('publisher') is-invalid @enderror"
                                   value="{{ old('publisher', $paper->publisher ?? '') }}">
                            @error('publisher')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="identifier">Identifier</label>
                            <input type="text" name="identifier" id="identifier"
                                   class="form-control @error('identifier') is-invalid @enderror"
                                   value="{{ old('identifier', $paper->identifier ?? '') }}">
                            @error('identifier')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="type">Type</label>
                            <select name="type" id="type" class="form-control @error('type') is-invalid @enderror">
                                <option value="">Select Type</option>
                                <option value="Dissertation" {{ (old('type', $paper->type ?? '') == 'Dissertation' ? 'selected' : '' }}>Dissertation</option>
                                <option value="Thesis" {{ (old('type', $paper->type ?? '') == 'Thesis' ? 'selected' : '' }}>Thesis</option>
                                <option value="Research Paper" {{ (old('type', $paper->type ?? '') == 'Research Paper' ? 'selected' : '' }}>Research Paper</option>
                                <option value="Article" {{ (old('type', $paper->type ?? '') == 'Article' ? 'selected' : '' }}>Article</option>
                                <option value="Report" {{ (old('type', $paper->type ?? '') == 'Report' ? 'selected' : '' }}>Report</option>
                            </select>
                            @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="language">Language</label>
                            <input type="text" name="language" id="language"
                                   class="form-control @error('language') is-invalid @enderror"
                                   value="{{ old('language', $paper->language ?? '') }}">
                            @error('language')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="download_permission" class="d-block">Download Permission</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="download_permission" id="download_permission"
                                       value="1" {{ (old('download_permission', $paper->download_permission ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="download_permission">Allow downloads</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Subject Keywords</label>

                        <div class="mb-2">
                            <label>Existing Keywords</label>
                            <select name="existing_keywords[]" class="form-control select2-multiple" multiple="multiple">
                                @foreach($allKeywords as $keyword)
                                    <option value="{{ $keyword->id }}"
                                        {{ (isset($paper) && $paper->keywords->contains($keyword->id)) ? 'selected' : '' }}>
                                        {{ $keyword->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-2">
                            <label>Add New Keywords (separate with commas , )</label>
                            <textarea name="new_keywords" class="form-control" rows="2"
                                      placeholder="e.g., education, technology, research">{{ old('new_keywords') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="abstract">Abstract</label>
                        <textarea name="abstract" id="abstract" class="form-control @error('abstract') is-invalid @enderror"
                                  rows="4">{{ old('abstract', $paper->abstract ?? '') }}</textarea>
                        @error('abstract')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                  rows="3">{{ old('description', $paper->description ?? '') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="file">PDF File {{ !isset($paper) ? '*' : '' }}</label>
                        <input type="file" name="file" id="file" class="form-control-file @error('file') is-invalid @enderror"
                               {{ !isset($paper) ? 'required' : '' }} accept=".pdf">
                        @error('file')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        @if(isset($paper) && $paper->file_path)
                            <div class="mt-2">
                                <small>Current file: {{ basename($paper->file_path) }} ({{ round($paper->file_size / 1024) }} KB)</small>
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="file_description">File Description</label>
                        <input type="text" name="file_description" id="file_description"
                               class="form-control @error('file_description') is-invalid @enderror"
                               value="{{ old('file_description', $paper->file_description ?? '') }}">
                        @error('file_description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    @push('styles')
                    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
                    <style>
                        .select2-container--default .select2-selection--multiple {
                            min-height: 38px;
                            border: 1px solid #ced4da;
                        }
                    </style>
                    @endpush

                    @push('scripts')
                    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            $('.select2-multiple').select2({
                                placeholder: "Select existing items",
                                allowClear: true
                            });
                        });
                    </script>
                    @endpush
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
