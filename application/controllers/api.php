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
    function get_chat_conversation_post() 
    {

        if( ! $this->post( 'stream' ) ){
            $error = array(
                'error'            => TRUE,
                'responseMessage'   => "HTTP error 400 - The conversation couldn't be retrieved because not stream was given.",
            );
            $this->response($error, HTTP_BAD_REQUEST);
        }

        $this->load->model('chat_message');
        $chatMessages = $this->chat_message->getConversation( $this->post( 'stream' ) );
        switch ( $chatMessages['error'] ) {
            case true:
            case false:
                $this->response( $chatMessages, HTTP_OK );
                break;
            default:
                $error = array(
                    'error'             => TRUE,
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

        if( ! $this->post( 'stream' ) || ! $this->post( 'text_message' ) || ! $this->post( 'from_user_id' ) || ! $this->post( 'to_user_id' ) ){
            $error = array(
                'error'             => TRUE,
                'responseMessage'   => "HTTP error 400 - The message couldn't be added because an argument was missing.",
            );
            $this->response($error, HTTP_BAD_REQUEST);
        }

        $this->load->model('chat_message');
        $addedMessage = $this->chat_message->addMessage( $this->post( 'stream' ), $this->post( 'text_message' ), $this->post( 'from_user_id' ), $this->post( 'to_user_id' ) );
        switch ( $addedMessage['error'] ) {
            case true:
            case false:
                $this->response( $addedMessage, HTTP_OK );
                break;
            default:
                $error = array(
                    'error'             => TRUE,
                    'responseMessage'   => "HTTP error 404. The message couldn't be added.",
                );
                $this->response( $error, HTTP_NOT_FOUND );
                break;
        }

    } // add_message_post

    /** 
     * Delete a message from a conversation
     */ 
    function delete_message_post() 
    {

        if( ! $this->post( 'id' ) ){
            $error = array(
                'error'             => TRUE,
                'responseMessage'   => "HTTP error 400 - The message couldn't be deleted because an argument was missing.",
            );
            $this->response($error, HTTP_BAD_REQUEST);
        }

        $this->load->model('chat_message');
        $deleted = $this->chat_message->deleteMessage( $this->post( 'id' ) );
        switch ( $deleted['error'] ) {
            case true:
            case false:
                $this->response( $deleted, HTTP_OK );
                break;
            default:
                $error = array(
                    'error'             => TRUE,
                    'responseMessage'   => "HTTP error 404. The message couldn't be deleted.",
                );
                $this->response( $error, HTTP_NOT_FOUND );
                break;
        }

    } // delete_message_post


} // class Api
?>