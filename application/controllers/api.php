<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Api extends REST_Controller
{

    /** 
     * Returns all chat messages in application
     */ 
    function get_chat_messages_post() 
    {

        $this->load->model('chat_message');
        $chatMessages = $this->chat_message->getMessages();
         
        if( ! $chatMessages['error'] ){
            $this->response( $chatMessages, HTTP_OK ); // 200 being the HTTP response code
        } else {
            $error = array(
                'error'            => TRUE,
                'responseMessage'   => "The messages couldn't be retrieved.",
            );
            $this->response($error, HTTP_NOT_FOUND);
        }

    } // get_chat_messages_post

    /** 
     * Returns a conversation for a given stream.
     */ 
    function get_conversation_from_user_post() 
    {
        $stream = $this->post( 'stream' );
        $user_id = $this->post( 'from_user_id' );

        if( ! $stream || ! $user_id ){
            $error = array(
                'error'             => MISSING_ARGUMENT,
                'responseMessage'   => MISSING_ARGUMENT_MSG . " - The conversation couldn't be retrieved.",
            );
            $this->response($error, HTTP_BAD_REQUEST);
        }

        $this->load->model('chat_message');
        $chatMessages = $this->chat_message->getConversationFromUser( $stream, $user_id );
        switch ( $chatMessages['error'] ) {
            case MISSING_ARGUMENT:
            case NO_ERROR:
                $this->response( $chatMessages, HTTP_OK );
                break;
            default:
                $error = array(
                    'error'             => 1,
                    'responseMessage'   => "The conversation couldn't be retrieved.",
                );
                $this->response( $error, HTTP_NOT_FOUND );
                break;
        }

    } // get_chat_conversation_post

    /** 
     * Adds a message to a chat conversation.
     */ 
    function add_message_post() 
    {
        $stream = $this->post( 'stream' );
        $text_message = $this->post( 'text_message' );
        $from_user_id = $this->post( 'from_user_id' );
        $to_user_id = $this->post( 'to_user_id' );

        if( ! $stream || ! $text_message || ! $from_user_id || ! $to_user_id ){
            $error = array(
                'error'             => MISSING_ARGUMENT,
                'responseMessage'   => MISSING_ARGUMENT_MSG . " - The message couldn't be added.",
            );
            $this->response($error, HTTP_BAD_REQUEST);
        }

        $this->load->model('chat_message');
        $addedMessage = $this->chat_message->addMessage( $stream, $text_message, $from_user_id, $to_user_id );
        switch ( $addedMessage['error'] ) {
            case MISSING_ARGUMENT:
            case NO_ERROR:
                $this->response( $addedMessage, HTTP_OK );
                break;
            default:
                $error = array(
                    'error'             => 1,
                    'responseMessage'   => "HTTP error 404. The message couldn't be added.",
                );
                $this->response( $error, HTTP_NOT_FOUND );
                break;
        }

    } // add_message_post

    /** 
     * Delete a message from a conversation
     */ 
    function delete_conversation_post() 
    {

        $stream = $this->post( 'stream' );
        $user_id = $this->post( 'from_user_id' );

        if( ! $stream || ! $user_id ){
            $error = array(
                'error'             => MISSING_ARGUMENT,
                'responseMessage'   => MISSING_ARGUMENT_MSG . " - The conversation couldn't be deleted.",
            );
            $this->response($error, HTTP_BAD_REQUEST);
        }

        $this->load->model('chat_message');
        $deleted = $this->chat_message->deleteConversation( $stream, $user_id );
        switch ( $deleted['error'] ) {
            case MISSING_ARGUMENT:
            case UNABLE_TO_DELETE:
            case NO_ERROR:
                $this->response( $deleted, HTTP_OK );
                break;
            default:
                $error = array(
                    'error'             => 1,
                    'responseMessage'   => "HTTP error 404. The conversation couldn't be deleted.",
                );
                $this->response( $error, HTTP_NOT_FOUND );
                break;
        }

    } // delete_conversation_post


} // class Api
?>