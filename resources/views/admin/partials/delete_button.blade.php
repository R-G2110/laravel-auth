<form
    class="d-inline-block"
    action="{{ route('admin.projects.destroy', $project) }}" method="POST"
    onsubmit="return confirm('Sei sicuro di voler eliminare {{$project->name}}?')"
>
    @csrf
    @method('DELETE')
    <button type="submit"  class="btn btn-danger"><i class="fa-regular fa-trash-can"></i></button>
</form>
