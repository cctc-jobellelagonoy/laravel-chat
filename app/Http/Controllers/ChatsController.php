<?php

namespace App\Http\Controllers;

use App\Events\MessageReceived;
use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show chats
     *
     * @return \Illuminate\Http\Response
     */

    //Returns the view for the chat interface.
    public function index()
    {
        return view('chats');
    }

    /**
     * Fetch all messages
     *
     * @return Message
     */

    //Retrieves all messages from the database and returns them as JSON data.
    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    // Creates a new message record in the database, using the currently authenticated user ID and 
    // the message text from the request body. 
    // Returns a response indicating that the message has been sent, 
    // along with the newly created message record.
    public function sendMessage(Request $request)
    {
       
        $user = Auth::user();
       
        $message = $user->messages()->create([
            'message' => $request->input('message'),
        ]);
     
        return ['status' => 'Message Sent!', 'savedMsg' => $message];
    }

    //Handles the request to the OpenAI API for generating a response to the user's message. 
    //Updates the database record for the current message with the AI's response and returns the response text.
    public function chatgpt(Request $request){
        $message = $request->msg;
        $id = $request->mid;
        $reply = $this->handleRequest($message);
    
        Message::where('id', $id)->update([
            'ai_reply' => $reply
        ]);

        return $reply;
    }

    // Sends a request to the OpenAI API using the Guzzle HTTP client, 
    // with the API key and user's message in the request body. 
    // Returns the response text from the API if successful, or an error message if an exception occurs.
    public function handleRequest($message){
      $reply = "...";
        try {
            $client = new Client();
            $response = $client->post('https://api.openai.com/v1/chat/completions', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                ],
                'json' => [
                    'model' => 'gpt-3.5-turbo',
                    'message' => $message,
                ],
            ]);
            $result = json_decode($response->getBody()->getContents(), true);
            $reply = response()->json($result['choices'][0]['text']);
        }
        catch (\Exception $e) {
            $status_code = $e->getCode();
            $error_message = $e->getMessage();
    
            switch ($status_code) {
                case 400:
                    // Handle the 400 Bad Request error
                    $reply = "Error: " . $error_message;
                    break;
                case 401:
                    // Handle the 401 Unauthorized error
                    $reply = "Error: " . $error_message;
                    break;
                case 403:
                    // Handle the 403 Forbidden error
                    $reply = "Error: " . $error_message;
                    break;
                case 429:
                    // Handle the 429 Too Many Requests error
                    $reply = "Error: " . $error_message;
                    break;
                case 500:
                    $reply = "Error: " . $error_message;
                    // Handle the 500 Internal Server Error
                    break;
                default:
                    // Handle any other errors
                    $reply = "I'm having trouble handling your request. Please try again later.";
                    break;
            }
        }
        return $reply;
    }

}
