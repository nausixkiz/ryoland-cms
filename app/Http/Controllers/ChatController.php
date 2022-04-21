<?php

namespace App\Http\Controllers\Admin;

use App\Events\Chat\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use function broadcast;
use function view;

class ChatController extends Controller
{
    public function index()
    {
        $pageConfigs = [
            'pageHeader' => false,
            'contentLayout' => "content-left-sidebar",
            'pageClass' => 'chat-application',
        ];

        return view('/content/chat/app-chat', [
            'pageConfigs' => $pageConfigs
        ]);
    }

    /**
     * Fetch all messages
     *
     * @return JsonResponse
     */
    public function fetchMessages(): JsonResponse
    {
        return $this->respondWithSuccess(ChatMessage::with('user')->get());
    }

    /**
     * Persist message to database
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function sendMessage(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();

            $validator = Validator::make($request->all(), [
                'message' => ['required', 'string', 'max:1000'],
                'other_user_id' => ['required', 'integer', 'exists:App\Models\User,id', Rule::notIn([$user->id])],
            ]);

            if ($validator->fails()) {
                return $this->respondFailedValidation($validator);
            }

            $otherUser = User::findOrFail($request->input('other_user_id'));

            $message = $user->messages()->create([
                'message' => $request->input('message')
            ]);

            broadcast(new MessageSent($user, $otherUser, $message))->toOthers();

            return $this->respondWithSuccess([
                'status' => 'Message Sent.'
            ]);
        } catch (Exception $e) {
            return $this->respondError($e->getMessage());
        }
    }
}
