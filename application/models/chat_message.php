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
	 * Returns all messages of a chat conversation between two users.
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
	 * Adds a new text message to an existing chat conversation.
	 * @param string $stream - A unique identifier for a chat conversation
	 * @param string $text_message 
	 * @param string $from_user_id 
	 * @param string $to_user_id 
	 * @return mixed array $insertMessageStatus
	 */
	public function addMessage( $stream, $text_message, $from_user_id, $to_user_id ){
		$insertMessageStatus = array();

		$messageData = array(
			'stream'		=> $stream,
			'text_message'	=> $text_message,		
			'from_user_id'	=> $from_user_id,	
			'to_user_id'	=> $to_user_id,	
			);
		$this->db->insert( 'chat_messages', $messageData );

		if ( $this->db->affected_rows() > 0 ){
			$insertMessageStatus['data']['id'] = $this->db->insert_id();
			$insertMessageStatus['error'] = FALSE;
			$insertMessageStatus['responseMessage'] = "Text message '$text_message' added successfully";
			return $insertMessageStatus;
		}

		$insertMessageStatus['error'] = TRUE;
		$insertMessageStatus['responseMessage'] = "The text message '$text_message' couldn't be added";
		return $insertMessageStatus;
	} // addMessage

	/**
	 * Deletes a message from an existing conversation.
	 * @param string $id - Message to be deleted
	 * @return mixed array $deleteMessageStatus
	 */
	public function deleteMessage( $text_message_id ){
		$deleteMessageStatus = array();

		$this->db->delete( 'chat_messages', array( 'id' => $text_message_id ) );
		$deleteMessageStatus['error'] = TRUE;
		$deleteMessageStatus['responseMessage'] = "The text message has been deleted.";

		return $deleteMessageStatus;

	} // deleteMessage

}