@if (isset($task->id))
<form action="{{ route('tasks.update', ["task" => $task]) }}" method="post">
    @csrf
    @method("PUT")
@else
<form action="{{ route('tasks.store') }}" method="post">
    @csrf
@endif
    <div class="card-body">
        <div class="card-title">
            @if (isset($task->id))
                <h5>Alterar Tarefa</h5>
            @else
                <h5>Nova Tarefa</h5>
            @endif
        </div>
        <div class="row">
            <div class="col-lg-3">
                <label for="item">Atividade</label>
                <input type="text" class="form-control" id="item" name="item" required value="{{ $task->item ?? "" }}">
            </div>
            <div class="col-lg-3">
                <label for="prev_start">Prev. Início</label>
                <input  type="date" class="form-control date campodatareadonly" data-defaultDate="" data-provide="datepicker" name="prev_start" id="prev_start" value="{{ ($task->prev_start ?? "")  }}">
            </div>
            <div class="col-lg-3">
                <label for="prev_end_date">Prev. Fim</label>
                <input  type="date" class="datepicker form-control date campodatareadonly" data-provide="datepicker" name="prev_end" id="prev_end" value="{{ ($task->prev_end ?? "")  }}">
            </div>
            <div class="col-lg-3">
                <label for="project">Projeto</label>
                <select name="project" id="project" class="form-control">
                    <option value=""></option>
                    @foreach ($projects as $p)
                        <option value="{{ $p->id }}" {{ ($task->project ?? "") == $p->id  ? 'selected' : '' }}>{{ $p->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="1" {{ ($task->status ?? "") == 1  ? 'selected' : '' }}>ANDAMENTO</option>
                    <option value="2" {{ ($task->status ?? "") == 2  ? 'selected' : '' }}>FINALIZADA</option>
                    <option value="3" {{ ($task->status ?? "") == 3  ? 'selected' : '' }}>ON HOLD</option>
                    <option value="4" {{ ($task->status ?? "") == 4  ? 'selected' : '' }}>CANCELADA</option>

                </select>
            </div>
            <div class="col-lg-3">
                <label for="out_date">Data Fim</label>
                <input type="date" class="form-control date campodatareadonly" data-provide="datepicker" name="out_date" id="out_date" value="{{ ($task->out_date ?? "")  }}">
            </div>
            <div class="col-lg-12">
                <lrabel for="description">Descrição Detalhada</label>
                <textarea class="form-control" name="description" id="description" rows="6" style="resize: vertical">{{ $task->description ?? ""  }}</textarea>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="col-lg-3">
            <input type="submit" value="Salvar" name="btn_submit" class="btn btn-success">
        </div>
    </div>
</form>
