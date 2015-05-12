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

    } // get_chat_messages_get

    /** 
     * Returns a conversation for a given stream.
     */ 
    function get_chat_conversation_post() 
    {

        if( ! $this->post( 'stream' ) ){
            $error = array(
                'error'            => TRUE,
                'responseMessage'   => "HTTP error 404. The conversation couldn't be retrieved.",
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

    } // get_chat_messages_get


} // class Api
?>