json.extract! room, :id, :title, :location, :description, :text, :created_at, :updated_at
json.url room_url(room, format: :json)