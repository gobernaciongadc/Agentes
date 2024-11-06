<!-- resources/views/personas/partials/actions.blade.php -->
<form action="{{ route('personas.destroy', $persona->id) }}" method="POST">
    <a class="btn btn-sm btn-primary" href="{{ route('personas.show', $persona->id) }}" title="Ver datos"><i class="fa fa-fw fa-eye"></i></a>
    <a class="btn btn-sm btn-success" href="{{ route('personas.edit', $persona->id) }}" title="Editar"><i class="fa fa-fw fa-edit"></i></a>
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta persona?');" title="Eliminar"><i class="fa fa-fw fa-trash"></i></button>
</form>