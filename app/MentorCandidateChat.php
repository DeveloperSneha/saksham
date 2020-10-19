<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MentorCandidateChat extends Model
{
    protected $primaryKey = 'idChat';
    protected $table = 'mentor_candidate_chats';
    protected $fillable = ['idSender','senderType','idReceiver','receiverType','message','sentAt','readAt','notified','status'];

}

