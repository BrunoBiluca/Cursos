using UnityEngine;

namespace Assets.Scripts.CameraScripts {
    public interface IFollowable {
        Vector3 GetPosition();
        Vector3 GetPositionOffset();
        bool StopFollow();
    }
}
