@if (isset($project->id))
<form action="{{ route('projects.update', ["project" => $project]) }}" method="post">
    @csrf
    @method("PUT")
@else
<form action="{{ route('projects.store') }}" method="post">
    @csrf
@endif
    <div class="card-body">
        <div class="card-title">
            @if (isset($project->id))
                <h5>Alterar Projeto</h5>
            @else
                <h5>Novo Projeto</h5>
            @endif
        </div>
        <div class="row">
            <div class="col-lg-3">
                <label for="name">Projeto</label>
                <input type="text" class="form-control" id="name" name="name" required value="{{ $project->name ?? "" }}">
            </div>
            <div class="col-lg-3">
                <label for="prev_start_date">Prev. Início</label>
                <input  type="date" class="form-control date campodatareadonly" data-defaultDate="" data-provide="datepicker" name="prev_start_date" id="prev_start_date" value="{{ ($project->prev_start_date ?? "")  }}">
            </div>
            <div class="col-lg-3">
                <label for="prev_end_date">Prev. Fim</label>
                <input  type="date" class="datepicker form-control date campodatareadonly" data-provide="datepicker" name="prev_end_date" id="prev_end_date" value="{{ ($project->prev_end_date ?? "")  }}">
            </div>

        </div>
        <div class="row">
            <div class="col-lg-3">
                <label for="start_date">Início</label>
                <input  type="date" class="form-control date campodatareadonly" data-defaultDate="" data-provide="datepicker" name="start_date" id="start_date" value="{{ ($project->start_date ?? "")  }}">
            </div>
            <div class="col-lg-3">
                <label for="end_date">Fim</label>
                <input  type="date" class="datepicker form-control date campodatareadonly" data-provide="datepicker" name="end_date" id="end_date" value="{{ ($project->end_date ?? "")  }}">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <lrabel for="description">Descrição Detalhada</label>
                <textarea class="form-control" name="description" id="description" rows="6" style="resize: vertical">{{ $project->description ?? ""  }}</textarea>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="col-lg-3">
            <input type="submit" value="Salvar" name="btn_submit" class="btn btn-success">
        </div>
    </div>
</form>
