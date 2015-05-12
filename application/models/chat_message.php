<?php
class Chat_message extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	} // constructor

	/**
	 * Returns all chat messages.
	 * @return mixed array $chatMessages
	 */
	public function getMessages(){
		$chatMessages = array();
		$numMessages = 0;

		$messagesQuery = $this->db->get( 'chat_messages' );
		$messagesResult = $messagesQuery->result();
		foreach ( $messagesResult as $key => $message_row )
		{
		    $chatMessages['data'][$key] = array(
		    	'stream' 		=> $message_row->stream,
		    	'text_message' 	=> $message_row->text_message,
		    	'from_user_id' 	=> $message_row->from_user_id,
		    	'to_user_id' 	=> $message_row->to_user_id,
		    	);
		    $numMessages = $key + 1;
		}

		$chatMessages['error'] = FALSE;
		$chatMessages['responseMessage'] = $numMessages . ' messages retrieved successfully!';
		return $chatMessages;
	} // getMessages

	/**
	 * Returns all messages of a conversation between two users.
	 * @param string $stream - A unique identifier for a chat
	 * @return mixed array $chatMessages
	 */
	public function getConversation( $stream ){
		$chatMessages = array();

		$conversationQuery = $this->db->get_where( 'chat_messages', array( 'stream' => $stream ) );
		$messagesResult = $conversationQuery->result();

		if( count( $messagesResult ) < 1 ) {
			$chatMessages['error'] = TRUE;
			$chatMessages['responseMessage'] = "No conversation was found for stream: '$stream'";
			return $chatMessages;
		}

		foreach ( $messagesResult as $key => $messageRow )
		{
		    $chatMessages['data'][$key] = array(
		    	'text_message' 	=> $messageRow->text_message,
		    	'from_user_id' 	=> $messageRow->from_user_id,
		    	'to_user_id' 	=> $messageRow->to_user_id,
		    	);
		}

		$chatMessages['error'] = FALSE;
		$chatMessages['responseMessage'] = 'Conversation retrieved successfully!';
		return $chatMessages;
	} // getConversation

	/**
	 * Returns a chat conversation between two users.
	 * @param string $stream - A unique identifier for a chat
	 * @return mixed array $chatMessages
	 */
	public function addMessage( $stream ){
		$chatMessages = array();

		$conversationQuery = $this->db->get_where( 'chat_messages', array( 'stream' => $stream ) );
		$messagesResult = $conversationQuery->result();

		if( count( $messagesResult ) < 1 ) {
			$chatMessages['error'] = TRUE;
			$chatMessages['responseMessage'] = "No conversation was found for stream: '$stream'";
			return $chatMessages;
		}

		foreach ( $messagesResult as $key => $messageRow )
		{
		    $chatMessages['data'][$key] = array(
		    	'text_message' 	=> $messageRow->text_message,
		    	'from_user_id' 	=> $messageRow->from_user_id,
		    	'to_user_id' 	=> $messageRow->to_user_id,
		    	);
		}

		$chatMessages['error'] = FALSE;
		$chatMessages['responseMessage'] = 'Conversation retrieved successfully!';
		return $chatMessages;
	} // addMessage
	
}