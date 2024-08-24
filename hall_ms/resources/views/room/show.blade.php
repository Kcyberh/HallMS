<x-studentlayout>
    <h1>Room Details</h1>
   
   
     <p><strong>Student Name:</strong> {{$booking->user->name}}</p>
     <p><strong>Hall Name:</strong> {{$booking->hall->name}}</p>
     <p><strong>Hall Block:</strong> {{$booking->hall->block}}</p>
        <p><strong>Room Number:</strong> {{$booking->room->number}}</p>
        
        <p><strong>Room Type:</strong> {{$booking->room->type}} in 1</p>
        <p><strong>Gender:</strong> {{$booking->gender}}</p>
        <p><strong>Contact:</strong> {{$booking->telephone}}</p>
   
        @if ($key)
        <p><strong>Key ID:</strong> {{$key->id}}</p>
        <p><strong>Key Code:</strong> {{$key->key_code}}</p>
    @else
        <p>No key assigned to this room.</p>
    @endif
</x-studentlayout>