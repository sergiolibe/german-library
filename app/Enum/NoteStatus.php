<?php
declare(strict_types=1);

namespace App\Enum;

enum NoteStatus: string
{
    case NOTE = 'NOTE'; // 1; // Simple note. Visible and active
    case NOTE_ARCHIVED = 'NOTE_ARCHIVED'; // 101; // Simple note. Not visible / not active. Only visible in archive scope
    case NOTE_DELETED = 'NOTE_DELETED'; // 102; // Simple note. Deleted. Only visible in trash
    case NOTE_HARD_DELETED = 'NOTE_HARD_DELETED'; // 103; // Deleted note that was in trash. Permanently Deleted. Not recoverable
    case ACTION = 'ACTION'; // 2; // Its a note with starts_at and ends_at. Visible and active
    case ACTION_ARCHIVED = 'ACTION_ARCHIVED'; // 201; // Its an action moved to archive. Only visible in archive scope
    case ACTION_COMPLETED = 'ACTION_COMPLETED'; // 202; // Its an action marked as completed
    case ACTION_PAUSED = 'ACTION_PAUSED'; // 203; // Its an action marked as paused
    case ACTION_CANCELLED = 'ACTION_CANCELLED'; // 204; // Its an action marked as cancelled
    case ACTION_DELETED = 'ACTION_DELETED'; // 205; // Its an action. Deleted. Only visible in trash
    case ACTION_HARD_DELETED = 'ACTION_HARD_DELETED'; // 206; // Deleted action that was in trash. Permanently Deleted. Not recoverable
    case IDEA = 'IDEA'; // 3; // Its a note which is almost an action. Visible and active
    case IDEA_INCUBATED = 'IDEA_INCUBATED'; // 301; // Its a note which is almost an action. Not visible / not active
    case IDEA_DELETED = 'IDEA_DELETED'; // 302; // Its an idea. Deleted. Only visible in trash
    case IDEA_HARD_DELETED = 'IDEA_HARD_DELETED'; // 303, // Deleted idea that was in trash. Permanently Deleted. Not recoverable
}
